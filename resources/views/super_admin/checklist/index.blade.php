@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Checklist</span>
            </h5>
        </div>
    </div>

    <!-- Checklist Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="checklistTable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th width="150">Action</th>
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

    $('#checklistTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('super.admin.checklist.getall') }}",
        columns: [

            // S.No
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },

            // Title
            { data: 'title' },

            // Department
            {
                data: 'department',
                render: function (data) {
                    return data ? data.department_name : '-';
                }
            },

            // Company
            {
                data: 'company',
                render: function (data) {
                    return data ? data.copmany_name : '-';
                }
            },

            // Description
            {
                data: 'description',
                render: function (data) {
                    if (!data) return '-';
                    return data.length > 50
                        ? data.substring(0, 50) + '...'
                        : data;
                }
            },

            // Created Date
            {
                data: 'created_at',
                render: function (data) {
                    if (!data) return '-';
                    let date = new Date(data);
                    return date.toLocaleDateString('en-IN');
                }
            },

            // Action
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/master/checklist/show/${id}"
                        class="btn btn-sm btn-info">
                        View
                        </a>


                        <a href="/master/checklist/${id}/qa" class="btn btn-sm btn-secondary">
                            Q&A
                        </a>
                    `;
                }
            }
        ]
    });

});
</script>
@endsection
