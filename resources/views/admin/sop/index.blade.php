@extends('admin.layouts.app')
@php
    use Illuminate\Support\Facades\Crypt;
@endphp
@section('style')
<style>
/* ================= PAGE ================= */
.container-p-y {
    background: #f6f7fb;
}

/* ================= TOOLBAR ================= */
.page-toolbar {
    background: #ffffff;
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.search-box {
    max-width: 260px;
}

/* ================= TABLE CARD ================= */
.table-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
}

/* ================= TABLE ================= */
.table {
    margin-bottom: 0;
}

.table thead th {
    background: #f9fafc;
    font-size: 13px;
    font-weight: 600;
    color: #6b7280;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}

.table tbody td {
    font-size: 14px;
    color: #374151;
    vertical-align: middle;
    white-space: nowrap;
}

.table tbody tr:hover {
    background: #f9fafb;
}

/* ================= BADGE ================= */
.badge-active {
    background: #22c55e;
    color: #fff;
    font-size: 11px;
    padding: 6px 12px;
    border-radius: 999px;
}

/* ================= BUTTONS ================= */
.btn-soft {
    border-radius: 8px;
    font-size: 12px;
    padding: 5px 12px;
}

.btn-view {
    background: #0ea5e9;
    color: #fff;
}

.btn-qa {
    background: #ef4444;
    color: #fff;
}

.btn-edit {
    background: #f59e0b;
    color: #fff;
}

.btn-delete {
    background: #9ca3af;
    color: #fff;
}

/* ================= ACTIONS ================= */
.action-btns {
    display: flex;
    gap: 6px;
}
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOOLBAR ================= -->
    <div class="page-toolbar d-flex justify-content-between align-items-center">

        <div class="d-flex gap-2">
            <input type="text"
                   id="search"
                   class="form-control search-box"
                   placeholder="Search SOP title...">
        </div>

        <div class="d-flex gap-2">
            <select id="department" class="form-select">
                <option value="">All Departments</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>

            <a href="{{ route('admin.sop.create') }}"
               class="btn btn-primary px-4">
                + Create SOP
            </a>
        </div>

    </div>

    <!-- ================= SOP TABLE ================= -->
    <div class="table-card">
        <div class="table-responsive">
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
            url: "{{ route('admin.sop.filter') }}",
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
