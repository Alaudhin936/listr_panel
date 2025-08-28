@extends('agencylayout.master')

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Choose Your Plan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($plans as $plan)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">₹{{ number_format($plan->price, 2) }}</h6>
                    <p class="card-text">
                        Duration: {{ $plan->duration_days }} days<br>
                        @if($plan->max_agents)
                        Max Agents: {{ $plan->max_agents }}
                        @endif
                    </p>
                    <form action="{{ route('subscription.initiate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection