@extends('admin.layouts.app')

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
            <input type="text" class="form-control" id="searchInput" placeholder="Search here..." style="width:220px;">
        </div>

        <div class="top-actions">
            <a href="{{ route('company.checklist.create') }}" class="btn btn-primary">
                + Create
            </a>
        </div>

    </div>


    <!-- ================= FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="mb-0">Checklists</h5>

        <select class="form-select w-auto" id="departmentFilter">
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
                        <th width="200">Department</th>
                        <th width="120">Document</th>
                        <th width="120">Status</th>
                        <th width="260">Action</th>
                    </tr>
                </thead>

                <tbody id="checklistTableBody">

                    @forelse ($checklists as $index => $checklist)
                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td class="fw-semibold">
                            {{ $checklist->title }}
                        </td>

                        <td>
                            {{ $checklist->department_names ?? '-' }}
                        </td>

                        <td>
                            <a href="{{ route('company.checklist.view', Crypt::encryptString($checklist->id)) }}"
                                target="_blank" class="btn btn-view btn-sm">
                                View
                            </a>
                        </td>

                        <td>
                            <span class="badge badge-active">
                                ACTIVE
                            </span>
                        </td>

                        <td>

                            <div class="action-btns">

                                <a href="{{ route('company.checklist.qa.create', $checklist->id) }}"
                                    class="btn btn-qa btn-sm">
                                    Q&A
                                </a>

                                <a href="{{ route('company.checklist.edit', $checklist->id) }}"
                                    class="btn btn-edit btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('company.checklist.destroy', $checklist->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this checklist?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No Checklists found
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection



@section('script')
<script>
    $(document).ready(function() {

            function loadChecklists() {

                let search = $('#searchInput').val();
                let departmentId = $('#departmentFilter').val();

                $.ajax({

                    url: "{{ route('company.checklist.filter') }}",
                    type: "GET",

                    data: {
                        search: search,
                        department_id: departmentId
                    },

                    beforeSend: function() {

                        $('#checklistTableBody').html(`
                            <tr>
                            <td colspan="6" class="text-center">
                            Loading...
                            </td>
                            </tr>
                        `);

                    },

                    success: function(res) {

                        let rows = '';

                        if (res.data.length > 0) {

                            $.each(res.data, function(index, checklist) {

                                rows += `

                                            <tr>

                                            <td>${index+1}</td>

                                            <td class="fw-semibold">
                                            ${checklist.title}
                                            </td>

                                            <td>
                                            ${checklist.department_names ? checklist.department_names : '-'}
                                            </td>

                                            <td>
                                            <a href="${checklist.file}"
                                            target="_blank"
                                            class="btn btn-view btn-sm">
                                            View
                                            </a>
                                            </td>

                                            <td>
                                            <span class="badge badge-active">
                                            ACTIVE
                                            </span>
                                            </td>

                                            <td>

                                            <div class="action-btns">

                                            <a href="/admin/checklist/qa/create/${checklist.id}"
                                            class="btn btn-qa btn-sm">
                                            Q&A
                                            </a>

                                            <a href="/admin/checklist/edit/${checklist.id}"
                                            class="btn btn-edit btn-sm">
                                            Edit
                                            </a>

                                            <form action="/admin/checklist/${checklist.id}"
                                                method="POST">

                                            <button type="submit"
                                                    class="btn btn-delete btn-sm">
                                            Delete
                                            </button>

                                            </form>

                                            </div>

                                            </td>

                                            </tr>

                                            `;

                            });

                        } else {

                            rows = `
                                <tr>
                                <td colspan="6" class="text-center text-muted">
                                No Checklists found
                                </td>
                                </tr>
                                `;

                        }

                        $('#checklistTableBody').html(rows);

                    }

                });

            }


            /* SEARCH */
            $('#searchInput').on('keyup', function() {
                loadChecklists();
            });


            /* FILTER */
            $('#departmentFilter').on('change', function() {
                loadChecklists();
            });


        });
</script>
@endsection