<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCustomerDetails()
    {
        return view('checkout.customer-details');
    }

    public function saveCustomerDetails(Request $request)
    {
        // Validate and save customer details here
        // Then redirect to the next step
        return redirect()->route('checkout.paymentMethod');
    }

    public function showPaymentMethod()
    {
        return view('checkout.payment-method');
    }

    public function savePaymentMethod(Request $request)
    {
        // Validate and save payment method here
        // Then redirect to the next step
        return redirect()->route('checkout.confirmation');
    }

    public function showConfirmation()
    {
        // Load order data for confirmation
        return view('checkout.confirmation');
    }
}

