@extends('admin.layouts.app')

@section('style')
<style>
    .table th {
        font-weight: 600;
        font-size: 13px;
        background: #f8f9fa;
    }

    .table td {
        font-size: 13px;
        vertical-align: middle;
    }

    /* ================= ACTION BUTTONS ================= */
    .action-btns {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .action-btns .btn {
        font-size: 11px;
        padding: 6px 0;
        border-radius: 6px;
        width: 120px;
        text-align: center;
    }

    .action-btns form {
        margin: 0;
    }

    .top-actions {
        display: flex;
        gap: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <input type="text" class="form-control" placeholder="Search here..." style="width:220px;">
            <button class="btn btn-primary">Search</button>
        </div>

        <div class="top-actions">
            <button class="btn btn-primary">Sort</button>
            <a href="{{ route('admin.checklist.create') }}" class="btn btn-primary">
                + Create
            </a>
        </div>
    </div>

    <!-- ================= FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Checklists</h5>

        <select class="form-select w-auto">
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
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th width="180">Department</th>
                        <th width="380">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($checklists as $index => $checklist)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <a href="{{ $checklist->file }}" target="_blank" class="fw-semibold">
                                    {{ $checklist->title }}
                                </a>
                            </td>

                            <!-- ================= DEPARTMENT ================= -->
                            <td>
                                {{ $checklist->department->department_name ?? '-' }}
                            </td>

                            <!-- ================= ACTION ================= -->
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.checklist.edit', $checklist->id) }}"
                                       class="btn btn-warning text-white">
                                        Edit
                                    </a>

                                    <a href=""
                                       class="btn btn-info text-white">
                                        Add Ques & Ans
                                    </a>

                                    <form action="{{ route('admin.checklist.destroy', $checklist->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this checklist?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
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
    // Future:
    // - AJAX department filter
    // - Search
    // - Sorting
</script>
@endsection
