<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class productController extends Controller
{
    function cards(){
        $items = Item::orderBy('created_at', 'desc')->paginate(12);
        return view('products.item', ['items' => $items]);
    }
}
