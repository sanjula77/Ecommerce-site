@extends('layouts.layout')
@section('title', 'Products')
@section('csss')
<style>
    .card {
      margin: 15px 0; /* Add spacing between cards */
    }
  
    .card-body {
      background-color: #f8f9fa; /* Light background */
      padding: 20px; /* Add some padding */
      border-radius: 8px; /* Rounded corners */
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
      text-align: center; /* Center text */
      transition: transform 0.2s ease; /* Smooth transition for hover effect */
    }
  
    .card-body:hover {
      transform: scale(1.05); /* Slightly enlarge card on hover */
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
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
    }
  </style>
@endsection
@section('content')
  
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-3">
        <div class="card">
          <img src="https://ae-pic-a1.aliexpress-media.com/kf/S0c59735be25143fea361085392704e2bf/Nylon-Handbags-Shoulder-Bag-Large-Capacity-Crossbody-Bags-for-Teenager-Girls-Men-Harajuku-Messenger-Bag-Student.jpg_640x640Q90.jpg_.webp" class="card-img-top" alt="Item 1 Image">
          <div class="card-body">
            <h5 class="card-title">Item 1</h5>
            <p class="card-text">This is a description for Item 1. It provides more details about the item.</p>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card">
         <img src="https://ae-pic-a1.aliexpress-media.com/kf/Se3d4e90fa9b049bda24b6ca179c46964j/ITAMOOD-Genuine-Leather-Women-s-Bag-Luxury-Branded-Women-s-Handbag-Fashionable-and-Versatile-Crossbody-Bag.jpg_640x640Q90.jpg_.webp" class="card-img-top" alt="Item 2 Image">
          <div class="card-body">
            <h5 class="card-title">Item 2</h5>
            <p class="card-text">This is a description for Item 2. It provides more details about the item.</p>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card">
         <img src="https://ae-pic-a1.aliexpress-media.com/kf/S68156e6fee404f6180570a5433a262d6J/Large-Capacity-Canvas-Solid-Letter-Tote-Bag-Versatile-Handbag-For-Commuter-Work-Student-Class-Underarm-Women.jpg_640x640Q90.jpg_.webp" class="card-img-top" alt="Item 3 Image">
          <div class="card-body">
            <h5 class="card-title">Item 3</h5>
            <p class="card-text">This is a description for Item 3. It provides more details about the item.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  

@endsection