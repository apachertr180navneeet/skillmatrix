@extends('admin.layouts.app')

@section('style')
<style>
    /* ================= SOP CARD ================= */
    .sop-card {
        background: #fff;
        border-radius: 22px;
        padding: 16px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        text-align: center;
        height: 100%;
        transition: all .2s ease;
    }

    .sop-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .sop-box {
        height: 120px;
        background: #1e78d6;
        border-radius: 16px;
        margin-bottom: 10px;
    }

    .sop-title {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 8px;
    }

    /* ================= ACTION BUTTONS ================= */
    .sop-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .sop-actions .btn {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 6px;
    }

    /* ================= TOP BAR ================= */
    .top-actions {
        display: flex;
        gap: 10px;
    }

    .top-actions .btn {
        padding: 6px 14px;
        font-size: 13px;
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
            <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
                + Create
            </a>
        </div>
    </div>

    <!-- ================= SUGGESTED video ================= -->
    <h5 class="mb-3">Suggestions Video</h5>

    <div class="row g-4 mb-5">
        @forelse ($videosuggestions as $videosuggestion)
            <div class="col-md-3">
                <div class="sop-card">
                    <a href="{{ $videosuggestion->is_link === 'yes'
                                ? $videosuggestion->video_link
                                : $videosuggestion->video_file }}"
                        target="_blank"
                        style="text-decoration:none;color:inherit;">
                        <div class="sop-box"></div>
                        <div class="sop-title">{{ $videosuggestion->title }}</div>

                        <!-- ACTION BUTTONS -->
                        <div class="sop-actions">
                            <!-- EDIT -->
                            <a href="{{ route('admin.video.edit', $videosuggestion->id) }}"
                            class="btn btn-warning text-white">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.video.destroy', $videosuggestion->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this Video?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                No Videos found
            </div>
        @endforelse
    </div>

    <!-- ================= CREATED SOP ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created SOP</h5>

        <select class="form-select w-auto">
            <option value="">Department</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">
                    {{ $department->department_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row g-4">
        @forelse ($videos as $video)
            <div class="col-md-3">
                <div class="sop-card">

                    <a href="{{ $video->is_link === 'yes'
                            ? $video->video_link
                            : $video->video_file }}"
                    target="_blank"
                    style="text-decoration:none;color:inherit;">
                        <div class="sop-box"></div>
                        <div class="sop-title">{{ $video->title }}</div>
                    </a>

                    <!-- ACTION BUTTONS -->
                    <div class="sop-actions">

                        <!-- ADD Q&A -->
                        <a href="{{ route('admin.video.qa.create', $video->id) }}"
                           class="btn btn-danger">
                            Add Q&A
                        </a>

                        <!-- EDIT -->
                        <a href="{{ route('admin.video.edit', $video->id) }}"
                           class="btn btn-warning text-white">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('admin.video.destroy', $video->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this Video?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                No SOPs found
            </div>
        @endforelse
    </div>

</div>
@endsection

@section('script')
<script>
    // Future: search, sort, department filter, ajax delete
</script>
@endsection
