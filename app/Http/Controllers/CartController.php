<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $request, $itemId){
        // Validate that the item exists
        $item = \App\Models\Item::findOrFail($itemId);
        
        $user = auth()->user();
        $cartItem = $user->cartItems()->where('item_id', $itemId)->first();

        if ($cartItem){
           $cartItem->increment('quantity');
        }else{
          $user->cartItems()->create([
            'item_id' => $itemId,
            'quantity' => 1
          ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }
    

public function viewCart(){
    // Get the logged-in user
    $user = Auth::user();

    // Retrieve the user's cart items with item details
    $cartItems = Cart::where('user_id', $user->id)
        ->with('item') // Load item details for each cart item
        ->get();

    // Filter out cart items where the item has been deleted
    $cartItems = $cartItems->filter(function ($cartItem) {
        return $cartItem->item !== null;
    });

    // Calculate the total cost
    $total = $cartItems->sum(function ($cartItem) {
        return $cartItem->item->price * $cartItem->quantity;
    });

    // Pass cart details to the view
    return view('cart.view', compact('cartItems', 'total'));
}


public function updateCart(Request $request, $item)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = Cart::where('id', $item)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return redirect()->back()->with('success', 'Cart updated successfully');
}

public function destroy($id)
{
    $cartItem = Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $cartItem->delete();

    return redirect()->back()->with('success', 'Item removed from the cart.');
}


}
