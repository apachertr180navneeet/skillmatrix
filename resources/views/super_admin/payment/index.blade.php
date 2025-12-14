@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Payments</span>
            </h5>
        </div>
    </div>

    <!-- Payment Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="paymentTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Subscription Plan Name</th>
                            <th>Party Name</th>
                            <th>Amount</th>
                            <th>UTR ID</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
$(document).ready(function () {

    $('#paymentTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('super.admin.payment.getall') }}",
        columns: [

            // Date
            {
                data: 'date',
                render: function (data) {
                    return data ? moment(data).format('DD-MM-YYYY') : '-';
                }
            },

            // Subscription Plan Name
            { data: 'plan_name' },

            // Party Name
            {
                data: 'company',
                render: function (data) {
                    return data ? data.name : '-';
                }
            },

            // Amount
            { data: 'amount' },

            // UTR ID
            {
                data: 'utr_id',
                render: function (data) {
                    return data ? data : '-';
                }
            }
        ]
    });

});
</script>
@endsection
