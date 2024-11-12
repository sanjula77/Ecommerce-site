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
            'image' => 'required|mimes:jpg,png,webp|max:2048',
            'name' =>'required|min:3',
            'description' => 'required|string',
            'price' =>'required|numeric',
            'category' =>'required'
        ]);
      $image = $request->file('image');
     $imagePath  = $image->store('uploads', 'public');
   // $imagePath = $request->file('image')->store('public/uploads');
    
    Item::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category' => $request->category,
        'image_path' => $imagePath
    ]);

    return redirect()->back()->with('error', 'Item added Unsuccessfully!');

    }
}
