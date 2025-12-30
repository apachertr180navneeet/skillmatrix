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
            <input type="text" class="form-control" placeholder="Search here..." style="width:220px;">
            <button class="btn btn-primary">Search</button>
        </div>

        <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
            + Create Video
        </a>
    </div>

    {{--  <!-- ================= SUGGESTED VIDEOS ================= -->
    <h5 class="mb-3">Suggested Videos</h5>

    <div class="card mb-5">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($videosuggestions as $key => $videosuggestion)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ $videosuggestion->is_link === 'yes'
                                    ? $videosuggestion->video_link
                                    : $videosuggestion->video_file }}"
                                   target="_blank">
                                    {{ $videosuggestion->title }}
                                </a>
                            </td>
                            <td>
                                {{ $videosuggestion->department->department_name ?? '-' }}
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin.video.edit', $videosuggestion->id) }}"
                                   class="btn btn-warning text-white">
                                    Edit
                                </a>

                                <form action="{{ route('admin.video.destroy', $videosuggestion->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this video?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-secondary">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Suggested Videos Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>  --}}

    <!-- ================= CREATED VIDEOS ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created Videos</h5>

        <select class="form-select w-auto">
            <option value="">Filter by Department</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">
                    {{ $department->department_name }}
                </option>
            @endforeach
        </select>
    </div>

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
                <tbody>
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
                                    <button class="btn btn-secondary">Delete</button>
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
