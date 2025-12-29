@extends('admin.layouts.app')

@section('style')
<style>
    .plan-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 30px 25px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        transition: all .2s ease;
        height: 100%;
        position: relative;
    }

    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.08);
    }

    .plan-card.active {
        border: 2px solid #198754;
        box-shadow: 0 0 0 3px rgba(25,135,84,.15);
    }

    .plan-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .plan-price {
        font-size: 36px;
        font-weight: 700;
        color: #4a5d73;
        margin: 6px 0;
    }

    .plan-period {
        color: #8b97a6;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .btn-buy {
        background: #233447;
        color: #fff;
        border-radius: 10px;
        padding: 12px;
        font-weight: 500;
    }

    .btn-buy:hover {
        background: #1b2938;
        color: #fff;
    }

    .current-badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <h5 class="fw-bold mb-4">Subscription Plan</h5>

    <div class="row g-4 justify-content-center">
        @foreach ($subcriptions as $subscription)
            @php
                $isCurrent = ($subscription->id == $currentPlanId);
            @endphp

            <div class="col-lg-4 col-md-6">
                <div class="plan-card text-center {{ $isCurrent ? 'active' : '' }}">

                    @if($isCurrent)
                        <span class="badge bg-success current-badge">
                            Current Plan
                        </span>
                    @endif

                    <h4 class="plan-title">
                        {{ $subscription->plan_name }}
                    </h4>
                    @if($isCurrent)
                        <p class="plan-period">
                            (Valid till {{ \Carbon\Carbon::parse($currentPlanEndDate)->format('d M, Y') }})
                        </p>
                    @else
                        <p class="plan-period">
                            (Duration: {{ $subscription->duration }} days)
                        </p>
                    @endif

                    <h2 class="plan-price">
                        Rs.{{ number_format($subscription->amount, 2) }}
                    </h2>

                    @if($isCurrent)
                        <button class="btn btn-secondary w-100" disabled>
                            Current Plan
                        </button>
                    @else
                        <form method="POST" action="{{ route('admin.subscription.buy', $subscription->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-buy w-100">
                                Buy Now
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
