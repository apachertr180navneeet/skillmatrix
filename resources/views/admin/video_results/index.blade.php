@extends('admin.layouts.app')

@section('style')
<style>
    /* ================= CARD ================= */
    .result-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* ================= TABLE ================= */
    .table thead th {
        font-size: 13px;
        font-weight: 600;
        color: #555;
        border-bottom: 1px solid #eaeaea;
        white-space: nowrap;
    }

    .table tbody td {
        font-size: 14px;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* ================= RESULT ================= */
    .result-badge {
        font-weight: 600;
        color: #1e78d6;
    }

    /* ================= BUTTON ================= */
    .btn-view {
        background: #1e78d6;
        color: #fff;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 6px;
        border: none;
    }

    .btn-view:hover {
        background: #155fb1;
        color: #fff;
    }

    /* ================= SEARCH ================= */
    .search-box {
        max-width: 260px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-semibold">Video Results</h5>

        <div class="d-flex gap-2">
            <input type="text" class="form-control search-box" placeholder="Search here...">
            <button class="btn btn-primary px-3">Search</button>
        </div>
    </div>

    <!-- ================= TABLE CARD ================= -->
    <div class="result-card">
        <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th>SR. No.</th>
                        <th>User Name</th>
                        <th>Department</th>
                        <th>Video Title</th>
                        <th>Result Status</th>
                        <th>Result</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($videoUserResults as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                {{ $row->user->full_name ?? '-' }}
                            </td>

                            <td>
                                {{ $row->user->department->department_name ?? '-' }}
                            </td>

                            <td>
                                {{ $row->video->title ?? '-' }}
                            </td>

                            <td>
                                @if($row->result_status === 'pass')
                                    <span class="badge bg-success">
                                        Pass
                                    </span>
                                @elseif($row->result_status === 'fail')
                                    <span class="badge bg-danger">
                                        Fail
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="result-badge">
                                    {{ $row->result }}%
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.video.result.view', $row->id) }}"
                                   class="btn btn-view">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No results found
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
    // Future scope:
    // - AJAX search
    // - Pagination
    // - Filters
</script>
@endsection
