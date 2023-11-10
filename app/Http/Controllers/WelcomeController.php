<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        if (App::isLocale('ru')) {
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

        $nodes = [
            [
                'name' => config('SETTINGS::MONITORING:NODE1:NAME') ? config('SETTINGS::MONITORING:NODE1:NAME') : 'CHANGE_ME',
                'load' => config('SETTINGS::MONITORING:NODE1:LOAD') ? config('SETTINGS::MONITORING:NODE1:LOAD') : 0,
            ],
            [
                'name' => config('SETTINGS::MONITORING:NODE2:NAME') ? config('SETTINGS::MONITORING:NODE2:NAME') : 'CHANGE_ME',
                'load' => config('SETTINGS::MONITORING:NODE2:LOAD') ? config('SETTINGS::MONITORING:NODE2:LOAD') : 0,
            ],
            [
                'name' => config('SETTINGS::MONITORING:NODE3:NAME') ? config('SETTINGS::MONITORING:NODE3:NAME') : 'CHANGE_ME',
                'load' => config('SETTINGS::MONITORING:NODE3:LOAD') ? config('SETTINGS::MONITORING:NODE3:LOAD') : 0,
            ],
            [
                'name' => config('SETTINGS::MONITORING:NODE4:NAME') ? config('SETTINGS::MONITORING:NODE4:NAME') : 'CHANGE_ME',
                'load' => config('SETTINGS::MONITORING:NODE4:LOAD') ? config('SETTINGS::MONITORING:NODE4:LOAD') : 0,
            ],
        ];

        return view('welcome')->with([
            'multiplier' => $multiplier,
            'products' => $products,
            'nodes' => $nodes,
        ]);
    }
}
