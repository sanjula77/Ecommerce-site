<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function showCustomerDetails()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('item')
            ->get()
            ->filter(fn($item) => $item->item !== null);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        return view('checkout.customer-details');
    }

    public function savePaymentMethod(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'cardholder_name' => 'required|string|max:255',
            'expiry_date' => 'required|date_format:Y-m',
            'cvv' => 'required|numeric|digits:3',
        ]);

        // Verify cart has items
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('item')
            ->get()
            ->filter(fn($item) => $item->item !== null);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Calculate total amount
        $totalAmount = $cartItems->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        // Store payment method in session for confirmation
        session([
            'payment_method' => $validatedData,
            'order_total' => $totalAmount
        ]);

        return redirect()->route('checkout.confirmation');
    }

    public function showPaymentMethod()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)
            ->with('item')
            ->get()
            ->filter(fn($item) => $item->item !== null);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Calculate total amount
        $totalAmount = $cartItems->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
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

        // Store customer details in session
        session(['customer_details' => $validatedData]);

        return redirect()->route('checkout.paymentMethod');
    }

    public function showConfirmation()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('item')
            ->get()
            ->filter(fn($item) => $item->item !== null);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        $customerDetails = session('customer_details', []);
        $paymentMethod = session('payment_method', []);

        return view('checkout.confirmation', [
            'total' => $subtotal,
            'cartItems' => $cartItems,
            'customerDetails' => $customerDetails,
            'paymentMethod' => $paymentMethod
        ]);
    }

    public function completeOrder(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('item')
            ->get()
            ->filter(fn($item) => $item->item !== null);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $customerDetails = session('customer_details');
        $paymentMethod = session('payment_method');
        $totalAmount = $cartItems->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        if (!$customerDetails || !$paymentMethod) {
            return redirect()->route('checkout.customerDetails')
                ->with('error', 'Please complete all checkout steps.');
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'shipping_name' => $customerDetails['name'],
            'shipping_email' => $customerDetails['email'],
            'shipping_mobile' => $customerDetails['mobile'],
            'shipping_address' => $customerDetails['address'],
            'shipping_province' => $customerDetails['province'],
            'shipping_city' => $customerDetails['city'],
            'shipping_postal_code' => $customerDetails['postal_code'],
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $cartItem->item_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->item->price,
                'name' => $cartItem->item->name,
            ]);
        }

        // Create payment record
        Payment::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'card_number' => $paymentMethod['card_number'],
            'cardholder_name' => $paymentMethod['cardholder_name'],
            'expiry_date' => $paymentMethod['expiry_date'],
            'cvv' => $paymentMethod['cvv'],
            'amount' => $totalAmount,
            'payment_status' => 'completed',
        ]);

        // Clear cart
        Cart::where('user_id', $user->id)->delete();

        // Clear session data
        session()->forget(['customer_details', 'payment_method', 'order_total']);

        return redirect()->route('order.thankYou', ['order' => $order->id])
            ->with('success', 'Order completed successfully!');
    }
}

