<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class adminController extends Controller
{
    function admin(){
        return view('admin.cardUpdate');
    }

    function insertData(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100'
        ]);
        
        $image = $request->file('image');
        $imagePath = $image->store('uploads', 'public');
        
        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image_path' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Item added successfully!');
    }
}
