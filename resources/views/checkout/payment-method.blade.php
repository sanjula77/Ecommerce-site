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

    .payment-methods label {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .payment-methods input[type="radio"] {
        margin-right: 10px;
    }

    .payment-details {
        display: none;
        margin-top: 20px;
    }

    .payment-details label {
        display: block;
        margin-top: 10px;
    }

    .payment-details input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }

    .payment-details p {
        margin-top: 10px;
        color: #555;
    }

    .container label[for="amount"] {
        display: block;
        margin-top: 20px;
    }

    .container input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
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


    .container button:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    @include('checkout.checkout-steps')

    <div class="payment-container">
        <h3>Payment Method</h3>

        <form action="{{ route('checkout.confirmation') }}" method="POST">
            @csrf
            
            <!-- Card Number -->
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" name="card_number" id="card_number" class="form-control" placeholder="1234 1234 1234 1234" required>
            </div>

            <!-- Cardholder Name -->
            <div class="form-group">
                <label for="cardholder_name">Name on Card</label>
                <input type="text" name="cardholder_name" id="cardholder_name" class="form-control" placeholder="John Doe" required>
            </div>

            <!-- Expiry Date and CVV in a row -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="month" name="expiry_date" id="expiry_date" class="form-control" placeholder="MM / YY" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" id="cvv" class="form-control" placeholder="123" required>
                </div>
            </div>

            <!-- Amount -->
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" value="LKR {{ $totalAmount }}.00" placeholder="Enter amount" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Next</button>
        </form>
    </div>
</div>
@endsection
