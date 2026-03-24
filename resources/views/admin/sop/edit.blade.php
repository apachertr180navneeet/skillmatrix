@extends('admin.layouts.app')

@section('style')

<!-- Select2 CSS -->
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
        padding: 12px 14px;
        font-size: 14px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        font-size: 12px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
    }

    .radio-box {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        color: #fff;
    }

    .ck-editor__editable {
        min-height: 180px;
    }

    /* select2 design */
    .select2-container--default .select2-selection--multiple {
        background: #f5f5f5;
        border-radius: 10px;
        border: 2px solid transparent;
        padding: 6px;
    }

</style>

@endsection


@section('content')

<div class="container-fluid container-p-y">

    <div class="form-card">

        <form action="{{ route('company.sop.update',$sop->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @php
            $selectedDepartments = explode(',', $sop->department_id);
            @endphp


            <!-- SOP TITLE -->

            <div class="mb-4">

                <label class="form-label">SOP Title</label>

                <input type="text" name="title" value="{{ old('title',$sop->title) }}" class="form-control @error('title') is-invalid @enderror">

                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- DEPARTMENT SELECT2 MULTI SELECT -->

            <div class="mb-4">

                <label class="form-label">Department</label>

                <select name="department_id[]" class="form-select select2 @error('department_id') is-invalid @enderror" multiple>

                    @foreach($departments as $department)

                    <option value="{{ $department->id }}" {{ in_array($department->id, old('department_id',$selectedDepartments)) ? 'selected' : '' }}>

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

                <input type="file" name="sop_upload" class="form-control @error('sop_upload') is-invalid @enderror">

                @if($sop->sop_upload)

                <p class="mt-2">
                    Current File :
                    <a href="{{ route('company.sop.view', Crypt::encryptString($sop->id)) }}" target="_blank">
                        View SOP
                    </a>
                </p>

                @endif

                @error('sop_upload')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- DESCRIPTION -->

            <div class="mb-4">

                <label class="form-label">Description</label>

                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">

                {{ old('description',$sop->description) }}

                </textarea>

                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>



            <!-- IS SUGGESTION -->

            <div class="mb-4">

                <label class="form-label">Is Suggestion</label>

                <div class="radio-group">

                    <label class="radio-box">
                        <input type="radio" name="is_suggestion" value="1" {{ old('is_suggestion',$sop->is_suggestion)==1 ? 'checked':'' }}>
                        Yes
                    </label>

                    <label class="radio-box">
                        <input type="radio" name="is_suggestion" value="0" {{ old('is_suggestion',$sop->is_suggestion)==0 ? 'checked':'' }}>
                        No
                    </label>

                </div>

            </div>



            <!-- SUBMIT -->

            <div class="text-end">

                <button type="submit" class="submit-btn">
                    Update SOP
                </button>

            </div>

        </form>

    </div>

</div>

@endsection



@section('script')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: "Select Department"
            , width: '100%'
        });

    });


    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

</script>

@endsection
