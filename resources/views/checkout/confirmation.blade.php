@extends('layouts.layout')
@section('content')
<div class="container">
    <h3>Order Confirmation</h3>
    <!-- Display order summary -->
    <div class="order-summary">
        <p>Subtotal: ${{ number_format($total, 2) }}</p>
        <p>Shipping: $5.00</p>
        <p>Total: ${{ number_format($total + 5, 2) }}</p>
    </div>
    <form action="{{ route('order.complete') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Confirm Payment</button>
    </form>
</div>
@endsection
