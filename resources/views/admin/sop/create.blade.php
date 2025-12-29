@extends('admin.layouts.app')

@section('style')
<style>
    /* ================= FORM CARD ================= */
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        max-width: 900px;
        margin: auto;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        background: #f5f5f5;
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        background: #f1f1f1;
    }

    textarea.form-control {
        resize: none;
    }

    /* ================= ERROR ================= */
    .is-invalid {
        border-color: #dc3545 !important;
        background: #fff5f5;
    }

    .invalid-feedback {
        display: block;
        font-size: 12px;
        color: #dc3545;
        margin-top: 4px;
    }

    /* ================= RADIO ================= */
    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 6px;
    }

    .radio-box {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .radio-box input[type="radio"] {
        accent-color: #dc3545;
    }

    /* ================= BUTTON ================= */
    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 24px;
        font-size: 14px;
        border-radius: 8px;
        color: #fff;
    }

    /* ================= CKEDITOR ================= */
    .ck-editor__editable {
        min-height: 180px;
        background: #fff !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="form-card">
        <form action="{{ route('admin.sop.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SOP TITLE -->
            <div class="mb-4">
                <label class="form-label">SOP Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="SOP title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- DEPARTMENT -->
            <div class="mb-4">
                <label class="form-label">Department</label>
                <select name="department_id"
                        class="form-select @error('department_id') is-invalid @enderror">
                    <option value="">Select department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- SOP FILE -->
            <div class="mb-4">
                <label class="form-label">SOP File Upload</label>
                <input type="file"
                       name="sop_upload"
                       class="form-control @error('sop_upload') is-invalid @enderror">
                @error('sop_upload')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- DESCRIPTION (CKEDITOR) -->
            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description"
                          id="description"
                          rows="5"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Enter SOP description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- YES / NO RADIO -->
            <div class="mb-4">
                <label class="form-label">Is Suggestion</label>
                <div class="radio-group">
                    <label class="radio-box">
                        <input type="radio"
                               name="is_suggestion"
                               value="1"
                               {{ old('is_suggestion') == '1' ? 'checked' : '' }}>
                        Yes
                    </label>

                    <label class="radio-box">
                        <input type="radio"
                               name="is_suggestion"
                               value="0"
                               {{ old('is_suggestion','0') == '0' ? 'checked' : '' }}>
                        No
                    </label>
                </div>
                @error('is_suggestion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- SUBMIT -->
            <div class="text-end">
                <button type="submit" class="submit-btn">
                    Save SOP
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@section('script')
<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', '|',
                'undo', 'redo'
            ],
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
