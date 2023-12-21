<?php

use App\Http\Controllers\ProductController as FrontProductController;
use Illuminate\Support\Facades\Route;

//server create utility routes (product)
//routes made for server create page to fetch product info

Route::get('/products/nodes/egg/{egg?}', [FrontProductController::class, 'getNodesBasedOnEgg'])->name('products.nodes.egg');
Route::get('/products/locations/egg/{egg?}', [FrontProductController::class, 'getLocationsBasedOnEgg'])->name('products.locations.egg');
Route::get('/products/products/{egg?}/{node?}', [FrontProductController::class, 'getProductsBasedOnNode'])->name('products.products.node');
