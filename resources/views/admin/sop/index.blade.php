@extends('admin.layouts.app')
@php
    use Illuminate\Support\Facades\Crypt;
@endphp
@section('style')
<style>
    .table th {
        font-size: 13px;
        font-weight: 600;
        background: #f8f9fa;
    }

    .table td {
        font-size: 13px;
        vertical-align: middle;
    }

    /* VIEW BUTTON */
    .btn-view {
        background: #0ea5e9;
        color: #fff;
        border-radius: 8px;
        padding: 4px 12px;
        font-size: 12px;
    }

    /* STATUS BADGE */
    .badge-active {
        background: #22c55e;
        color: #fff;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
    }

    /* ACTION BUTTON GROUP */
    .action-btns {
        display: flex;
        gap: 8px;
    }

    /* Q&A BUTTON */
    .btn-qa {
        background: #ef4444;
        color: #fff;
        border-radius: 8px;
        padding: 4px 12px;
        font-size: 12px;
    }

    /* EDIT BUTTON */
    .btn-edit {
        background: #f59e0b;
        color: #fff;
        border-radius: 8px;
        padding: 4px 12px;
        font-size: 12px;
    }

    /* DELETE BUTTON */
    .btn-delete {
        background: #9ca3af;
        color: #fff;
        border-radius: 8px;
        padding: 4px 12px;
        font-size: 12px;
    }

    .top-actions {
        display: flex;
        gap: 10px;
    }

    .table-bordered {
        border-collapse: separate;
    }

    .table-bordered td,
    .table-bordered th {
        border-top: none !important;
        border-bottom: none !important;
    }

    .table-bordered tbody tr td,
    .table-bordered tbody tr th {
        border-top: none !important;
        border-bottom: none !important;
    }

    .table-bordered thead th {
        border-bottom: none !important;
    }
</style>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="d-flex gap-2">
            <input type="text" class="form-control" id="search" placeholder="Search here..." style="width:220px;">
        </div>

        <div class="top-actions">
            <a href="{{ route('company.sop.create') }}" class="btn btn-primary">
                + Create
            </a>
        </div>

    </div>


    <!-- ================= FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="mb-0">SOP</h5>

        <select class="form-select w-auto" id="department">
            <option value="">Department</option>

            @foreach ($departments as $department)
            <option value="{{ $department->id }}">
                {{ $department->department_name }}
            </option>
            @endforeach

        </select>

    </div>



    <!-- ================= TABLE ================= -->
    <div class="card">
        <div class="card-body table-responsive">

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th width="120">Document</th>
                        <th width="120">Status</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody id="sopTableBody">
                    @include('admin.sop.table_rows', ['sops' => $sops])
                </tbody>
            </table>

        </div>
    </div>

</div>


@endsection

@section('script')
<script>
$(document).ready(function () {

    function fetchSops() {
        let search = $('#search').val();
        let department = $('#department').val();

        $.ajax({
            url: "{{ route('company.sop.filter') }}",
            type: "GET",
            data: {
                search: search,
                department_id: department
            },
            success: function (response) {
                $('#sopTableBody').html(response);
            }
        });
    }

    // 🔍 Live search
    $('#search').on('keyup', function () {
        fetchSops();
    });

    // 🏷️ Department filter
    $('#department').on('change', function () {
        fetchSops();
    });

});
</script>
@endsection
