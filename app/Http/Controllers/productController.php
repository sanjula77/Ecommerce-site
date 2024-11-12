<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class productController extends Controller
{
    function cards(){
        $items = Item::all();
        return view('products.item', ['items' => $items]);
        
    }
}
