@extends('admin.layouts.app')

@section('style')

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

/* ================= SELECT2 FIX ================= */
.select2-container--default .select2-selection--multiple {
    background: #f5f5f5;
    border-radius: 10px;
    border: 2px solid transparent;
    min-height: 45px;
    padding: 5px;
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
</style>

@endsection


@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <div class="form-card">

        <form action="{{ route('company.checklist.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- CHECKLIST TITLE -->
            <div class="mb-4">
                <label class="form-label">Checklist Title</label>

                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Checklist title">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- DEPARTMENT MULTIPLE SELECT -->
            <div class="mb-4">
                <label class="form-label">Department</label>

                <select name="department_id[]"
                        id="department_select"
                        multiple
                        class="form-select @error('department_id') is-invalid @enderror">

                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ collect(old('department_id'))->contains($department->id) ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach

                </select>

                @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- CHECKLIST FILE -->
            <div class="mb-4">
                <label class="form-label">Checklist File Upload</label>

                <input type="file"
                       name="checklist_upload"
                       class="form-control @error('checklist_upload') is-invalid @enderror">

                @error('checklist_upload')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- DESCRIPTION -->
            <div class="mb-4">
                <label class="form-label">Description</label>

                <textarea name="description"
                          id="description-editor"
                          rows="5"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Description">{{ old('description') }}</textarea>

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
                    Save Checklist
                </button>
            </div>

        </form>

    </div>

</div>

@endsection


@section('script')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>

$(document).ready(function () {

    /* ================= SELECT2 ================= */

    $('#department_select').select2({
        placeholder: "Select Department",
        allowClear: true,
        width: '100%'
    });


    /* ================= CKEDITOR ================= */

    ClassicEditor
        .create(document.querySelector('#description-editor'), {
            toolbar: [
                'heading','|',
                'bold','italic','underline','link',
                'bulletedList','numberedList','|',
                'blockQuote','undo','redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });

});

</script>

@endsection