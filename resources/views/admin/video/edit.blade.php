@extends('admin.layouts.app')

@section('style')
<style>
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        max-width: 900px;
        margin: auto;
    }
    .form-label { font-weight: 600; font-size: 14px; }
    .form-control, .form-select {
        background: #f5f5f5;
        border-radius: 10px;
        padding: 12px;
    }
    .is-invalid { border-color: #dc3545 !important; }
    .invalid-feedback { font-size: 12px; color: #dc3545; }
</style>
@endsection

@section('content')
<div class="container-fluid container-p-y">

    <div class="form-card">
        <form action="{{ route('admin.video.update', $video->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div class="mb-4">
                <label class="form-label">Video Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $video->title) }}"
                       class="form-control @error('title') is-invalid @enderror">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- DEPARTMENT -->
            <div class="mb-4">
                <label class="form-label">Department</label>
                <select name="department_id"
                        class="form-select @error('department_id') is-invalid @enderror">
                    <option value="">Select department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id', $video->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- VIDEO FILE -->
            <div class="mb-4">
                <label class="form-label">Video Upload</label>
                <input type="file"
                       name="video_upload"
                       class="form-control @error('video_upload') is-invalid @enderror">

                @if($video->video_upload)
                    <div class="mt-2">
                        Current Video:
                        <a href="{{ asset($video->video_file) }}" target="_blank">View</a>
                    </div>
                @endif

                @error('video_upload') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control">{{ old('description', $video->description) }}</textarea>
            </div>

            <!-- IS SUGGESTION -->
            <div class="mb-4">
                <label class="form-label">Is Suggestion</label><br>
                <label>
                    <input type="radio" name="is_suggestion" value="1"
                        {{ old('is_suggestion', $video->is_suggestion) == 1 ? 'checked' : '' }}>
                    Yes
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="is_suggestion" value="0"
                        {{ old('is_suggestion', $video->is_suggestion) == 0 ? 'checked' : '' }}>
                    No
                </label>
            </div>

            <!-- SUBMIT -->
            <div class="text-end">
                <button class="btn btn-primary">Update Video</button>
            </div>

        </form>
    </div>
</div>
@endsection
