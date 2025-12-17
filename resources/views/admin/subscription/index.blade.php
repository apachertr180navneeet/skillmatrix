@extends('admin.layouts.app')

@section('style')
<style>
    .overview-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: #1e78d6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-content h6 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-content p {
        margin: 0;
        font-size: 13px;
        color: #555;
    }
</style>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <h5 class="fw-bold mb-4">Subscription Plan</h5>
    <div class="row g-4">

        <!-- BASIC PLAN -->
        @foreach ($subcriptions as $subscription)
            <div class="col-lg-4 col-md-6">
                <div class="plan-card text-center">
                    <h4 class="plan-title">Basic Plan</h4>
                    <p class="text-muted mb-1">Start at</p>
                    <h2 class="plan-price">Rs.50</h2>
                    <p class="text-muted">/ Month</p>
                <button class="btn btn-dark w-100 mb-3">Buy Now</button>
            </div>
        @endforeach

    </div>
</div>

</div>


@endsection
