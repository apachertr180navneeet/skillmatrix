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
    .form-label {
        font-weight: 600;
        font-size: 14px;
    }
    .form-control {
        background: #f5f5f5;
        border-radius: 10px;
        padding: 12px 14px;
    }
    .question-card {
        background: #fafafa;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #eee;
        margin-bottom: 20px;
    }
    .option-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
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
<form action="{{ route('admin.checklist.qa.store') }}" method="POST">
@csrf

@php
    // 🔑 EXACT DB FIELD MAP
    $optionMap = [
        1 => 'option_one',
        2 => 'option_two',
        3 => 'option_three',
        4 => 'option_four',
    ];
@endphp

<!-- CHECKLIST TITLE -->
<div class="mb-4">
    <label class="form-label">Checklist Title</label>
    <input type="text" class="form-control" value="{{ $checklistdetails->title }}" readonly>
    <input type="hidden" name="checklist_id" value="{{ $checklistdetails->id }}">
</div>

<!-- QUESTIONS -->
<div id="questionWrapper">

@if($checklistquesans->count() > 0)

@foreach($checklistquesans as $qIndex => $qa)

<div class="question-card">

    <label class="form-label">Question {{ $qIndex + 1 }}</label>

    <input type="text"
        name="questions[{{ $qIndex }}][question]"
        class="form-control mb-3"
        value="{{ $qa->question }}"
        required>

    @foreach([1,2,3,4] as $i)
    <div class="option-row">
        <input type="radio"
            name="questions[{{ $qIndex }}][correct]"
            value="{{ $i }}"
            {{ $qa->answer_option === $optionMap[$i] ? 'checked' : '' }}
            required>

        <input type="text"
            name="questions[{{ $qIndex }}][options][{{ $i }}]"
            class="form-control"
            value="{{ $qa->{$optionMap[$i]} }}"
            required>
    </div>
    @endforeach

</div>

@endforeach

@else
<!-- DEFAULT QUESTION -->
<div class="question-card">
<label class="form-label">Question 1</label>

<input type="text"
    name="questions[0][question]"
    class="form-control mb-3"
    placeholder="Enter question"
    required>

@foreach([1,2,3,4] as $i)
<div class="option-row">
    <input type="radio"
        name="questions[0][correct]"
        value="{{ $i }}"
        required>

    <input type="text"
        name="questions[0][options][{{ $i }}]"
        class="form-control"
        placeholder="Option {{ $i }}"
        required>
</div>
@endforeach
</div>
@endif

</div>

<div class="text-end">
<button type="submit" class="submit-btn">
Save Checklist Q&A
</button>
</div>

</form>
</div>
</div>
@endsection
