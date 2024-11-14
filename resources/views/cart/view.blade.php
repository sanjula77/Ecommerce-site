@extends('layouts.layout')
@section('title', 'Order Details')
@section('content')
<div class="container cart-container my-5">
    <div class="row">
        <!-- Cart Items Section -->
        <div class="col-md-8">
            <h4>Shopping Cart</h4>
            <hr>
            <div class="d-flex justify-content-between cart-header">
                <div class="col-6">Product Details</div>
                <div class="col-2 text-center">Quantity</div>
                <div class="col-2 text-center">Price</div>
                <div class="col-2 text-center">Total</div>
            </div>
            <hr>

            @if($cartItems->isEmpty())
                <p>Your cart is empty.</p>
            @else
                @foreach($cartItems as $cartItem)
                <div class="d-flex justify-content-between align-items-center py-3">
                    <div class="col-6 d-flex align-items-center">
                        <img src="{{ asset('storage/' . $cartItem->item->image_path) }}" alt="{{ $cartItem->item->name }}" class="img-fluid" style="width: 90px; margin-right: 25px;">
                        <div class="ml-6">
                            <h6>{{ $cartItem->item->name }}</h6>
                            <small>{{ $cartItem->item->category }}</small><br>
                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger btn btn-link p-0">Remove</button>
                            </form>
                        </div>
                        
                    </div>
                    <div class="col-2 text-center">
                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="d-inline update-quantity-form">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control d-inline text-center quantity-input" style="width: 50px;" min="1">
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Add</button>
                        </form>
                    </div>
                                        
                    <div class="col-2 text-center">${{ number_format($cartItem->item->price, 2) }}</div>
                    <div class="col-2 text-center total-price">${{ number_format($cartItem->item->price * $cartItem->quantity, 2) }}</div>
                </div>
                <hr>
                
                @endforeach
            @endif

            <a href="#" class="text-primary"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
        </div>

        <!-- Order Summary Section -->
        <div class="col-md-4">
            <div class="order-summary p-4 bg-light rounded">
                <h4 class="mb-4">Order Summary</h4>
                
                <div class="d-flex justify-content-between py-3">
                    <span>Items {{ $cartItems->count() }}</span>
                    <span class="order-total">${{ number_format($total, 2) }}</span>
                </div>

                <div class="form-group mt-4 mb-4">
                    <label for="shipping">Shipping</label>
                    <select id="shipping" class="form-control">
                        <option>Standard Delivery - $5.00</option>
                        <option>Express Delivery - $10.00</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="promo-code">Promo Code</label>
                    <input type="text" id="promo-code" class="form-control" placeholder="Enter your code">
                </div>

                <button class="btn btn-danger btn-block mb-4">Apply</button>
                
                <hr class="my-4">
                
                <div class="d-flex justify-content-between mb-4">
                    <h5>Total Cost</h5>
                    <h5 class="final-total">${{ number_format($total + 5, 2) }}</h5> <!-- Assume $5 for shipping as default -->
                </div>

                <a href="{{route('checkout.customerDetails')}}" class="btn btn-primary btn-block">Checkout</a>
            </div>
        </div>

    </div>
</div>

@endsection
