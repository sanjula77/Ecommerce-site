<!-- resources/views/checkout/_checkout-steps.blade.php -->
<div class="checkout-steps d-flex justify-content-around my-4">
    <div class="step {{ request()->is('checkout/customer-details') ? 'active' : '' }}">Customer Details</div>
    <div class="step {{ request()->is('checkout/payment-method') ? 'active' : '' }}">Payment Method</div>
    <div class="step {{ request()->is('checkout/confirmation') ? 'active' : '' }}">Confirmation</div>
</div>
