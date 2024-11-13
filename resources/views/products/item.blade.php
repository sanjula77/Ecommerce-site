@extends('layouts.layout')
@section('title', 'Products')
@section('csss')
<style>
    .card {
      margin: 15px 0;
    }
    .card-body {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.2s ease;
    }
  
    .card-body:hover {
      transform: scale(1.05);
    }
  
    .card-title {
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 10px;
    }
  
    .card-text {
      font-size: 0.9rem;
      color: #555;
    }
  .card-img-top {
    width: 100%;
    height: 300px; 
     
    border-radius: 8px;
    margin-bottom: 15px;
}

    .price-section {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 15px;
      font-weight: bold;
      font-size: 1rem;
      color: #333;
    }

    .price-section .price {
      font-size: 1.2rem;
      color: #333;
      margin-right: 40px; 
    }

    .cart-icon {
      width: 24px;
      height: 24px;
      margin-left: 30px; 
    }

    .buy-now-btn {
      margin-top: 15px;
      padding: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      width: 100%;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .buy-now-btn:hover {
      background-color: #555;
    }
</style>
@endsection

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
       @foreach($items as $item)
          <div class="col-3 mb-4">
              <div class="card">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->name }} Image">
                  <div class="card-body">
                      <h5 class="card-title">{{ $item->name }}</h5>
                      <p class="card-text">{{ $item->description }}</p>
                      <div class="price-section">
                          <span class="price">LKR.{{ $item->price }}</span>
                          <form action="{{ route('cart.add', $item->id) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn p-0" style="background:none; border:none;">
                                  <img src="https://www.iconpacks.net/icons/2/free-icon-add-to-cart-3046.png" alt="Add to Cart Icon" class="cart-icon">
                              </button>
                          </form>
                      </div>
                      <button class="btn btn-primary buy-now-btn">Buy Now</button>
                  </div>
              </div>
          </div>
       @endforeach
    </div>
</div>

@endsection
