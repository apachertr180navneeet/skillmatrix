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

                    if (!data) return '-';

                    let d = new Date(data);

                    let day = ("0" + d.getDate()).slice(-2);
                    let month = ("0" + (d.getMonth()+1)).slice(-2);
                    let year = d.getFullYear();

                    return day + "-" + month + "-" + year;
                }
            },

            // Subscription Plan Name
            {
                data: 'plan_name',
                defaultContent: '-'
            },

            // Company Name
            {
                data: 'company.copmany_name',
                defaultContent: '-'
            },

            // Amount
            {
                data: 'amount',
                render: function (data) {
                    return data ? '₹ ' + data : '-';
                }
            },

            // UTR ID
            {
                data: 'utr_id',
                defaultContent: '-'
            }

        ]

    });

});
</script>

@endsection