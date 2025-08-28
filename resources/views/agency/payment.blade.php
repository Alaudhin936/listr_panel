@extends('agencylayout.master')

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Complete Payment</h4>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plan: {{ $plan->name }}</h5>
                    <h6 class="card-subtitle mb-4">Amount: ₹{{ number_format($plan->price, 2) }}</h6>
                    
                    <form action="{{ route('subscription.success') }}" method="POST">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" value="{{ $order['id'] }}">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                        
                        <button id="rzp-button" class="btn btn-primary btn-block">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $key }}",
        "amount": "{{ $order['amount'] }}",
        "currency": "INR",
        "name": "Your Company Name",
        "description": "Payment for {{ $plan->name }}",
        "image": "{{ asset('path/to/your/logo.png') }}",
        "order_id": "{{ $order['id'] }}",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.forms[0].submit();
        },
        "prefill": {
            "name": "{{ $user->name }}",
            "email": "{{ $user->email }}",
            "contact": "{{ $user->phone }}"
        },
        "theme": {
            "color": "#F37254"
        }
    };
    
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault();
    }
    
    // Auto open payment modal when page loads
    window.onload = function() {
        rzp.open();
    };
</script>
@endsection