@extends('admin.layouts.app')

@section('style')
<style>
    .table-actions .btn {
        padding: 4px 10px;
        font-size: 12px;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <input type="text"
                   class="form-control"
                   id="searchInput"
                   placeholder="Search here..."
                   style="width:220px;">
        </div>

        <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
            + Create Video
        </a>
    </div>

    <!-- ================= FILTER BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created Videos</h5>

        <select class="form-select w-auto" id="departmentFilter">
            <option value="">Filter by Department</option>
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
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <!-- IMPORTANT ID -->
                <tbody id="videoTableBody">
                    @forelse ($videos as $key => $video)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ $video->is_link === 'yes'
                                    ? $video->video_link
                                    : $video->video_file }}"
                                   target="_blank">
                                    {{ $video->title }}
                                </a>
                            </td>
                            <td>
                                {{ $video->department->department_name ?? '-' }}
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.video.qa.create', $video->id) }}"
                                   class="btn btn-danger">
                                    Add Q&A
                                </a>

                                <a href="{{ route('admin.video.edit', $video->id) }}"
                                   class="btn btn-warning text-white">
                                    Edit
                                </a>

                                <form action="{{ route('admin.video.destroy', $video->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this video?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-secondary">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Videos Found
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
$(document).ready(function () {

    function loadVideos() {
        let search = $('#searchInput').val();
        let departmentId = $('#departmentFilter').val();

        $.ajax({
            url: "{{ route('admin.video.filter') }}",
            type: "GET",
            data: {
                search: search,
                department_id: departmentId
            },
            beforeSend: function () {
                $('#videoTableBody').html(`
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                `);
            },
            success: function (res) {

                let rows = '';

                if (res.data.length > 0) {
                    $.each(res.data, function (index, video) {

                        let videoUrl = video.is_link === 'yes'
                            ? video.video_link
                            : video.video_file;

                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <a href="${videoUrl}" target="_blank">
                                        ${video.title}
                                    </a>
                                </td>
                                <td>${video.department ? video.department.department_name : '-'}</td>
                                <td class="table-actions">
                                    <a href="/admin/video/qa/create/${video.id}"
                                       class="btn btn-danger">
                                        Add Q&A
                                    </a>

                                    <a href="/admin/video/edit/${video.id}"
                                       class="btn btn-warning text-white">
                                        Edit
                                    </a>

                                    <form action="/admin/video/${video.id}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this video?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-secondary">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Videos Found
                            </td>
                        </tr>
                    `;
                }

                $('#videoTableBody').html(rows);
            }
        });
    }

    // 🔍 Search click
    $('#searchBtn').on('click', function () {
        loadVideos();
    });

    // ⌨️ Live search
    $('#searchInput').on('keyup', function () {
        loadVideos();
    });

    // 🏷️ Department filter
    $('#departmentFilter').on('change', function () {
        loadVideos();
    });

});
</script>
@endsection
