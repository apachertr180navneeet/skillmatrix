@extends('admin.layouts.app')

@section('style')

<!-- SELECT2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
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
    }

    .form-control,
    .form-select {
        background: #f5f5f5;
        border-radius: 10px;
        padding: 12px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        font-size: 12px;
        color: #dc3545;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 6px;
    }

</style>

@endsection



@section('content')

<div class="container-fluid container-p-y">

    <div class="form-card">

        <form action="{{ route('admin.video.update',$video->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @php
            $selectedDepartments = explode(',', $video->department_id);
            @endphp


            <!-- TITLE -->
            <div class="mb-4">

                <label class="form-label">Video Title</label>

                <input type="text" name="title" value="{{ old('title',$video->title) }}" class="form-control @error('title') is-invalid @enderror">

                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- DEPARTMENT MULTIPLE -->
            <div class="mb-4">

                <label class="form-label">Department</label>

                <select name="department_id[]" id="department_id" multiple class="form-select select2 @error('department_id') is-invalid @enderror">

                    @foreach($departments as $department)

                    <option value="{{ $department->id }}" {{ in_array($department->id,$selectedDepartments) ? 'selected' : '' }}>

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

                    <label>
                        <input type="radio" name="is_link" value="yes" {{ old('is_link',$video->is_link) === 'yes' ? 'checked' : '' }}>
                        Video Link
                    </label>

                    <label>
                        <input type="radio" name="is_link" value="no" {{ old('is_link',$video->is_link) === 'no' ? 'checked' : '' }}>
                        Upload Video
                    </label>

                </div>

            </div>



            <!-- VIDEO LINK -->
            <div class="mb-4 d-none" id="videoLinkBox">

                <label class="form-label">Video Link</label>

                <input type="text" name="video_link" value="{{ old('video_link',$video->video_link) }}" class="form-control @error('video_link') is-invalid @enderror">

                @error('video_link')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- VIDEO UPLOAD -->
            <div class="mb-4" id="videoUploadBox">

                <label class="form-label">Upload Video</label>

                <input type="file" name="video_upload" class="form-control @error('video_upload') is-invalid @enderror">

                @if($video->is_link === 'no' && $video->video_file)

                <div class="mt-2">
                    Current Video :
                    <a href="{{ $video->video_file }}" target="_blank">View</a>
                </div>

                @endif

                @error('video_upload')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label">Description</label>

                <textarea name="description" id="description" rows="5" class="form-control">

                {{ old('description',$video->description) }}

                </textarea>

            </div>



            <!-- IS SUGGESTION -->
            <div class="mb-4">

                <label class="form-label">Is Suggestion</label>

                <div class="radio-group">

                    <label>
                        <input type="radio" name="is_suggestion" value="1" {{ old('is_suggestion',$video->is_suggestion) == 1 ? 'checked' : '' }}>
                        Yes
                    </label>

                    <label>
                        <input type="radio" name="is_suggestion" value="0" {{ old('is_suggestion',$video->is_suggestion) == 0 ? 'checked' : '' }}>
                        No
                    </label>

                </div>

            </div>



            <!-- SUBMIT -->
            <div class="text-end">

                <button class="btn btn-primary">
                    Update Video
                </button>

            </div>

        </form>

    </div>

</div>

@endsection



@section('script')

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SELECT2 -->
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


        /* VIDEO LINK / UPLOAD TOGGLE */

        const radios = document.querySelectorAll('input[name="is_link"]');
        const linkBox = document.getElementById('videoLinkBox');
        const uploadBox = document.getElementById('videoUploadBox');

        function toggleFields(value) {

            if (value === 'yes') {
                linkBox.classList.remove('d-none');
                uploadBox.classList.add('d-none');
            } else {
                uploadBox.classList.remove('d-none');
                linkBox.classList.add('d-none');
            }

        }

        const checked = document.querySelector('input[name="is_link"]:checked');

        if (checked) {
            toggleFields(checked.value);
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleFields(this.value);
            });
        });


        /* CKEDITOR */

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    });

</script>

@endsection
