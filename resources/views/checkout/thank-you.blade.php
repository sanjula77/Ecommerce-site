@extends('layouts.layout')

@section('content')
<div class="container my-5 text-center">
    <h2>Thank You for Your Order!</h2>
    <p>Your order has been successfully completed. We appreciate your business!</p>

    <div class="order-summary mt-4">
        <p>If you have any questions about your order, please contact our support team.</p>
    </div>

    <a href="{{ route('products') }}" class="btn btn-primary mt-3">Return to Home</a>
</div>
@endsection
