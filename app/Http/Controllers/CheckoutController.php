<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCustomerDetails()
    {
        return view('checkout.customer-details');
    }

    public function savePaymentMethod(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|date_format:Y-m',
            'cvv' => 'required|numeric|digits:3',
            'amount' => 'required|numeric|min:0'
        ]);

        // Retrieve user's cart
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();

        // Save payment details
        Payment::create([
            'user_id' => auth()->id(),
            'cart_id' => $cart->id,
            'card_number' => $validatedData['card_number'],
            'cardholder_name' => $validatedData['cardholder_name'],
            'expiry_date' => $validatedData['expiry_date'],
            'cvv' => $validatedData['cvv'],
            'amount' => $validatedData['amount']
        ]);

        return redirect()->route('checkout.confirmation');
        
    }

    public function showPaymentMethod()
    {
        $userId = Auth::id(); // Get the logged-in user's ID
    $cartItems = \App\Models\Cart::where('user_id', $userId)->get();

    // Calculate total amount
    $totalAmount = $cartItems->sum(function ($cart) {
        return $cart->item->price * $cart->quantity; // Ensure `item` relationship exists in Cart model
    });

    return view('checkout.payment-method', compact('totalAmount'));
   

    }

    public function saveCustomerDetails(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10'
        ]);

        // Save customer details
        $user = auth()->user();
        $user->update($validatedData);

        return redirect()->route('checkout.paymentMethod');
    }

    public function showConfirmation()
    {
        $user = auth()->user();
    
        if ($user && $user->carts->isNotEmpty()) {
            $subtotal = $user->carts->sum(function ($cart) {
                return $cart->item->price * $cart->quantity;
            });
        } else {
            $subtotal = 0;
        }
    
        return view('checkout.confirmation', [
            'total' => $subtotal
        ]);
    }
     
   


public function completeOrder(Request $request)
{
    $user = auth()->user();

    $user->carts()->delete();

    // Redirect to a thank-you page or order summary
    return redirect()->route('order.thankYou')->with('success', 'Order completed successfully!');
}

}

