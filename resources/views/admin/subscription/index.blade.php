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
    .plan-title { font-size: 20px; font-weight: 600; }
    .plan-price { font-size: 36px; font-weight: 700; color: #4a5d73; }
    .plan-period { color: #8b97a6; font-size: 14px; margin-bottom: 20px; }
    .btn-buy { background: #233447; color: #fff; border-radius: 10px; }
    .btn-buy:hover { background: #1b2938; color: #fff; }
    .current-badge { position: absolute; top: 15px; right: 15px; }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <h5 class="fw-bold mb-4">Subscription Plan</h5>

    {{-- ================= PURCHASED SUBSCRIPTIONS TABLE ================= --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">
            Purchased Subscriptions
        </div>

        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Used / Total</th>
                        <th>Remaining</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $sub)
                        <tr>
                            <td>{{ $sub->used_users }} / {{ $sub->user_count }}</td>
                            <td>{{ $sub->user_count - $sub->used_users }}</td>
                            <td>
                                @if($sub->is_locked == 1)
                                    <span class="badge bg-danger">Locked</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No subscriptions purchased yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= AVAILABLE PLANS ================= --}}
    <div class="row g-4 justify-content-center">
        @foreach ($subcriptions as $subscription)
            @php $isCurrent = ($subscription->id == $currentPlanId); @endphp

            <div class="col-lg-4 col-md-6">
                <div class="plan-card text-center {{ $isCurrent ? 'active' : '' }}">

                    @if($isCurrent)
                        <span class="badge bg-success current-badge">Current Plan</span>
                    @endif

                    <h4 class="plan-title">{{ $subscription->plan_name }}</h4>

                    <p class="plan-period">
                        {{ $isCurrent
                            ? 'Valid till '.\Carbon\Carbon::parse($currentPlanEndDate)->format('d M, Y')
                            : 'Duration: '.$subscription->duration.' days'
                        }}
                    </p>

                    <h2 class="plan-price">
                        ₹{{ number_format($subscription->amount, 2) }}
                    </h2>

                    @if($isCurrent)
                        <button
                            class="btn btn-success w-100 openAddUserModal"
                            data-bs-toggle="modal"
                            data-bs-target="#buyPlanModal"
                            data-plan-id="{{ $subscription->id }}"
                            data-plan-name="{{ $subscription->plan_name }}"
                            data-plan-amount="{{ $subscription->amount }}"
                        >
                            ➕ Add More Users
                        </button>
                    @else
                        <button
                            class="btn btn-buy w-100 openBuyModal"
                            data-bs-toggle="modal"
                            data-bs-target="#buyPlanModal"
                            data-plan-id="{{ $subscription->id }}"
                            data-plan-name="{{ $subscription->plan_name }}"
                            data-plan-amount="{{ $subscription->amount }}"
                        >
                            Buy Now
                        </button>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="buyPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Confirm Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="buyPlanForm">
                @csrf
                <input type="hidden" name="action_type" id="actionType" value="buy">

                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h6 id="modalPlanName"></h6>
                        <h3 class="fw-bold text-primary">
                            ₹<span id="modalPlanAmount">0</span>
                        </h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Number of Users</label>
                        <input type="number" name="user_count" id="userCountInput"
                               class="form-control" min="1" value="1" required>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success px-4">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let basePrice = 0;

    // BUY NEW PLAN
    document.querySelectorAll('.openBuyModal').forEach(btn => {
        btn.onclick = () => {
            basePrice = parseFloat(btn.dataset.planAmount);
            document.getElementById('modalTitle').innerText = 'Confirm Subscription';
            document.getElementById('modalPlanName').innerText = btn.dataset.planName;
            document.getElementById('modalPlanAmount').innerText = basePrice.toFixed(2);
            document.getElementById('actionType').value = 'buy';
            document.getElementById('buyPlanForm').action =
                "{{ url('admin/subscription/buy') }}/" + btn.dataset.planId;
            document.getElementById('userCountInput').value = 1;
        };
    });

    // ADD USERS TO CURRENT PLAN
    document.querySelectorAll('.openAddUserModal').forEach(btn => {
        btn.onclick = () => {
            basePrice = parseFloat(btn.dataset.planAmount);
            document.getElementById('modalTitle').innerText = 'Add Users to Current Plan';
            document.getElementById('modalPlanName').innerText =
                btn.dataset.planName + ' (Add Users)';
            document.getElementById('modalPlanAmount').innerText = basePrice.toFixed(2);
            document.getElementById('actionType').value = 'add_user';
            document.getElementById('buyPlanForm').action =
                "{{ url('admin/subscription/add-users') }}/" + btn.dataset.planId;
            document.getElementById('userCountInput').value = 1;
        };
    });

    // PRICE × USER COUNT
    document.getElementById('userCountInput').addEventListener('input', function () {
        let count = parseInt(this.value) || 1;
        this.value = count;
        document.getElementById('modalPlanAmount').innerText =
            (basePrice * count).toFixed(2);
    });
</script>
@endsection
