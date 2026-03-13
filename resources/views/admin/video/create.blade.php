@extends('admin.layouts.app')

@section('style')

<!-- SELECT2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* ================= FORM CARD ================= */
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
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
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
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
        font-size: 12px;
        color: #dc3545;
        margin-top: 4px;
    }

    /* ================= RADIO ================= */
    .radio-group {
        display: flex;
        gap: 25px;
        margin-top: 8px;
    }

    .radio-box {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .radio-box input {
        accent-color: #1e78d6;
    }

    /* ================= BUTTON ================= */
    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 28px;
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
    }

    /* SELECT2 STYLE */
    .select2-container--default .select2-selection--multiple {
        border-radius: 10px;
        padding: 6px;
    }

</style>

@endsection


@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="form-card">

        <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- VIDEO TITLE -->
            <div class="mb-4">
                <label class="form-label">Video Title</label>

                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Video title">

                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- DEPARTMENT MULTIPLE SELECT -->
            <div class="mb-4">
                <label class="form-label">Department</label>

                <select name="department_id[]" id="department_id" multiple class="form-select select2 @error('department_id') is-invalid @enderror">

                    @foreach($departments as $department)

                    <option value="{{ $department->id }}" {{ collect(old('department_id'))->contains($department->id) ? 'selected' : '' }}>

                        {{ $department->department_name }}

                    </option>

                    @endforeach

                </select>

                @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <!-- VIDEO SOURCE -->
            <div class="mb-4">

                <label class="form-label">Video Source</label>

                <div class="radio-group">

                    <label class="radio-box">
                        <input type="radio" name="is_link" value="yes" {{ old('is_link') == 'yes' ? 'checked' : '' }}>
                        Video Link
                    </label>

                    <label class="radio-box">
                        <input type="radio" name="is_link" value="no" {{ old('is_link','no') == 'no' ? 'checked' : '' }}>
                        Upload Video
                    </label>

                </div>

                @error('is_link')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

            </div>


            <!-- VIDEO LINK -->
            <div class="mb-4 d-none" id="videoLinkBox">

                <label class="form-label">Video Link</label>

                <input type="text" name="video_link" class="form-control @error('video_link') is-invalid @enderror" value="{{ old('video_link') }}" placeholder="https://youtube.com/...">

                @error('video_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <!-- VIDEO UPLOAD -->
            <div class="mb-4" id="videoUploadBox">

                <label class="form-label">Upload Video File</label>

                <input type="file" name="video_upload" class="form-control @error('video_upload') is-invalid @enderror">

                @error('video_upload')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label">Description</label>

                <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Video description">{{ old('description') }}</textarea>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <!-- IS SUGGESTION -->
            <div class="mb-4">

                <label class="form-label">Is Suggestion</label>

                <div class="radio-group">

                    <label class="radio-box">
                        <input type="radio" name="is_suggestion" value="1" {{ old('is_suggestion') == '1' ? 'checked' : '' }}>
                        Yes
                    </label>

                    <label class="radio-box">
                        <input type="radio" name="is_suggestion" value="0" {{ old('is_suggestion','0') == '0' ? 'checked' : '' }}>
                        No
                    </label>

                </div>

                @error('is_suggestion')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror

            </div>


            <!-- SUBMIT -->
            <div class="text-end">

                <button type="submit" class="submit-btn">
                    Save Video
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@section('script')

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SELECT2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {

        /* SELECT2 MULTIPLE */
        $('#department_id').select2({
            placeholder: "Select Department"
            , width: '100%'
        });


        /* CKEDITOR */
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });


        /* VIDEO SOURCE TOGGLE */

        const radios = document.querySelectorAll('input[name="is_link"]');
        const linkBox = document.getElementById('videoLinkBox');
        const uploadBox = document.getElementById('videoUploadBox');

        function toggleField(value) {

            if (value === 'yes') {

                linkBox.classList.remove('d-none');
                uploadBox.classList.add('d-none');

            } else {

                uploadBox.classList.remove('d-none');
                linkBox.classList.add('d-none');

            }

        }

        const selected = document.querySelector('input[name="is_link"]:checked');

        if (selected) {
            toggleField(selected.value);
        }

        radios.forEach(radio => {

            radio.addEventListener('change', function() {

                toggleField(this.value);

            });

        });

    });

</script>

@endsection
