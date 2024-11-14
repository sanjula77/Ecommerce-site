@extends('layouts.layout')

@section('csss')
<style>
    /* Existing styles */
    .checkout-steps {
        font-size: 1.2em;
        margin-bottom: 20px;
    }
    .checkout-steps .step {
        padding: 10px 15px;
        color: #777;
        font-weight: 500;
    }
    .checkout-steps .step.active {
        color: #28a745; /* Green color or any color that fits your theme */
        font-weight: 700;
        border-bottom: 2px solid #28a745;
    }

    /* New styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .payment-container {
        width: 500px;
        margin: 30px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .payment-container h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .container button {
        width: 90%; /* or use a specific width like 200px */
        padding: 6px; /* reduces height by decreasing padding */
        font-size: 16px; /* optionally reduce font size */
        background-color: #007BFF;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
        margin-left: 20px;
    }

    .container button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    @include('checkout.checkout-steps')

    <div class="payment-container">
        <h3>Customer Details</h3>

        <form action="{{ route('checkout.customerDetails') }}" method="POST">
            @csrf
            
            <!-- Full Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Mobile Number -->
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" name="mobile" class="form-control" required>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <!-- Province and City in a Row -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="province">Province</label>
                    <input type="text" name="province" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
            </div>

            <!-- Postal Code -->
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
</div>
@endsection
