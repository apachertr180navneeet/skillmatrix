@extends('web.userlayouts.app')

@section('style')
<style>
    .qa-card {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        max-width: 1000px;
        margin: auto;
    }

    .checklist-title-box {
        background: #f1f1f1;
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: 600;
    }

    .question-title {
        font-weight: 600;
        margin-bottom: 12px;
    }

    .option-box {
        background: #f6f6f6;
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .option-box input {
        transform: scale(1.1);
        cursor: pointer;
    }

    .submit-btn {
        padding: 10px 30px;
        font-size: 15px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid container-p-y">

    <div class="qa-card">

        <h4 class="mb-3">Checklist Q&amp;A</h4>

        <!-- CHECKLIST TITLE -->
        <div class="mb-3">
            <label class="fw-bold mb-1">Checklist Title</label>
            <div class="checklist-title-box">
                {{ $checklistDetails->title }}
            </div>
        </div>

        <!-- TOTAL QUESTIONS -->
        <p class="text-danger fw-bold">
            Total {{ $checklistQuesAns->count() }} questions
        </p>

        <!-- QUESTIONS FORM -->
        <form action="{{ route('user.checklist.qa.submit') }}" method="POST">
            @csrf

            <input type="hidden" name="checklist_id" value="{{ $checklistDetails->id }}">

            @foreach($checklistQuesAns as $index => $qa)

                <div class="mb-4">

                    <!-- QUESTION -->
                    <div class="question-title">
                        Q{{ $index + 1 }}. {{ $qa->question }}
                    </div>

                    <input type="hidden" name="ques_id[]" value="{{ $qa->id }}">

                    <!-- OPTION 1 -->
                    @if(!empty($qa->option_one))
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[{{ $qa->id }}]"
                                   value="1"
                                   required>
                            {{ $qa->option_one }}
                        </label>
                    @endif

                    <!-- OPTION 2 -->
                    @if(!empty($qa->option_two))
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[{{ $qa->id }}]"
                                   value="2">
                            {{ $qa->option_two }}
                        </label>
                    @endif

                    <!-- OPTION 3 -->
                    @if(!empty($qa->option_three))
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[{{ $qa->id }}]"
                                   value="3">
                            {{ $qa->option_three }}
                        </label>
                    @endif

                    <!-- OPTION 4 -->
                    @if(!empty($qa->option_four))
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[{{ $qa->id }}]"
                                   value="4">
                            {{ $qa->option_four }}
                        </label>
                    @endif

                </div>

            @endforeach

            <!-- SUBMIT -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary submit-btn">
                    Submit Checklist
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
