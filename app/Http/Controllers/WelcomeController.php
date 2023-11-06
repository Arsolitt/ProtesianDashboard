<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if (Session::get('locale') == 'ru') {
            $multiplier = 1;
        } else {
            $multiplier = 100;
        }

        $products_response = Cache::get('products');
        if ($products_response == null) {
            $products_response = Product::query()
                ->where('disabled', '=', false)
                ->orderBy('price')
                ->get();
            Cache::put('products', $products_response, 43200);
        }
        $products = json_decode($products_response, true);
        return view('welcome')->with([
            'multiplier' => $multiplier,
            'products' => $products
        ]);
    }
}
