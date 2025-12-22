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
        padding: 12px 14px;
    }
    .is-invalid { border-color: #dc3545 !important; background: #fff5f5; }
    .invalid-feedback { font-size: 12px; color: #dc3545; }
    .radio-group { display: flex; gap: 20px; }
    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container-fluid container-p-y">

    <div class="form-card">
        <form action="{{ route('admin.checklist.update', $checklist->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div class="mb-4">
                <label class="form-label">Checklist Title</label>
                <input type="text" name="title"
                       value="{{ old('title', $checklist->title) }}"
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
                            {{ old('department_id', $checklist->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- FILE -->
            <div class="mb-4">
                <label class="form-label">Checklist File</label>
                <input type="file" name="checklist_upload"
                       class="form-control @error('checklist_upload') is-invalid @enderror">

                @if($checklist->file)
                    <small class="d-block mt-2">
                        Current File:
                        <a href="{{$checklist->file}}" target="_blank">
                            View File
                        </a>
                    </small>
                @endif
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4"
                          class="form-control">{{ old('description', $checklist->description) }}</textarea>
            </div>

            <!-- IS SUGGESTION -->
            <div class="mb-4">
                <label class="form-label">Is Suggestion</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="is_suggestion" value="1"
                            {{ old('is_suggestion', $checklist->is_suggestion) == 1 ? 'checked' : '' }}>
                        Yes
                    </label>
                    <label>
                        <input type="radio" name="is_suggestion" value="0"
                            {{ old('is_suggestion', $checklist->is_suggestion) == 0 ? 'checked' : '' }}>
                        No
                    </label>
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="text-end">
                <button class="submit-btn">Update Checklist</button>
            </div>

        </form>
    </div>

</div>
@endsection
