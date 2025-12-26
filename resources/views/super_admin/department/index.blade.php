@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">SOP</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            {{--  <a href="" class="btn btn-primary">
                Add SOP
            </a>  --}}
        </div>
    </div>

    <!-- SOP Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="sopTable">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Company</th>
                            <th>Status</th>
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

    $('#sopTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('super.admin.departments.getall') }}",
        columns: [

            // Department Name
            { data: 'department_name' },

            // Company (relation)
            {
                data: 'company',
                render: function (data) {
                    return data ? data.name : '-';
                }
            },


            // Status
            {
                data: 'status',
                render: function (data) {
                    return data === 'active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                }
            },
        ]
    });

});
</script>
@endsection
