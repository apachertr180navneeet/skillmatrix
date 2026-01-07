@extends('web.userlayouts.app')

@section('style')
<style>
    /* ================= RESULT CARD ================= */
    .result-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    /* ================= QUESTION ================= */
    .question-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 12px;
    }

    /* ================= OPTIONS ================= */
    .option-box {
        border-radius: 10px;
        padding: 10px 14px;
        margin-bottom: 8px;
        font-size: 14px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .option-selected {
        background: #e7f1ff;
        border-color: #1e78d6;
        color: #1e78d6;
        font-weight: 600;
    }

    .option-wrong {
        background: #fdecea;
        border-color: #dc3545;
        color: #dc3545;
        font-weight: 600;
    }

    .option-label {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .option-selected .option-label { background: #1e78d6; color: #fff; }
    .option-wrong .option-label    { background: #dc3545; color: #fff; }

    /* ================= HEADER ================= */
    .result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .badge-pass {
        background: #e6f4ea;
        color: #198754;
        font-weight: 600;
    }

    .badge-fail {
        background: #fdecea;
        color: #dc3545;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= HEADER ================= -->
    <div class="result-header">
        <h5 class="mb-0 fw-semibold">Result Details</h5>

        <div>
            <span class="badge {{ $result->result_status === 'pass' ? 'badge-pass' : 'badge-fail' }}">
                {{ ucfirst($result->result_status) }}
            </span>
            <span class="ms-2 fw-semibold">
                {{ $result->result }}%
            </span>
        </div>
    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="result-card mb-4">
        <div class="row g-3">

            <div class="col-md-4">
                <strong>SOP Title</strong><br>
                <span class="text-muted">{{ $result->sop->title ?? '-' }}</span>
            </div>

            <div class="col-md-4">
                <strong>User Name</strong><br>
                <span class="text-muted">{{ $result->user->full_name ?? '-' }}</span>
            </div>

            <div class="col-md-4">
                <strong>Email</strong><br>
                <span class="text-muted">{{ $result->user->email ?? '-' }}</span>
            </div>

            <div class="col-md-3">
                <strong>Total Questions</strong><br>
                <span class="fw-semibold">
                    {{ $result->total_questions }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Correct</strong><br>
                <span class="fw-semibold text-success">
                    {{ $result->correct_answers }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Wrong</strong><br>
                <span class="fw-semibold text-danger">
                    {{ $result->wrong_answers }}
                </span>
            </div>

            <div class="col-md-3">
                <strong>Score</strong><br>
                <span class="fw-semibold">
                    {{ $result->result }}%
                </span>
            </div>

                <div class="col-md-3">
                    <strong>Status</strong><br>
                    <span class="badge {{ $result->result_status === 'pass' ? 'badge-pass' : 'badge-fail' }}">
                        {{ ucfirst($result->result_status) }}
                    </span>
                </div>

                <div class="col-md-3">
                    <strong>Attempt Date</strong><br>
                    <span class="text-muted">
                        {{ $result->created_at->format('d M Y, h:i A') }}
                    </span>
                </div>

            </div>
        </div>
    </div>


    <!-- ================= QUESTIONS & ANSWERS ================= -->
    <div class="mt-4">

        @forelse($questiondeatil as $index => $question)
            <div class="result-card">

                <div class="question-title">
                    Q{{ $index + 1 }}. {{ $question['question'] }}
                </div>

                @php
                    $correctAnswer = (int) $question['correct_answer'];
                    $userAnswer    = (int) $question['user_answer'];
                @endphp

                @foreach($question['options'] as $key => $option)
                    @php
                        $optionNumber = $key + 1;
                        $class = '';

                        // ONLY user-selected option highlighted
                        if ($optionNumber === $userAnswer && $userAnswer === $correctAnswer) {
                            $class = 'option-selected';
                        }

                        if ($optionNumber === $userAnswer && $userAnswer !== $correctAnswer) {
                            $class = 'option-wrong';
                        }
                    @endphp

                    <div class="option-box">
                        <div>{{ $option }}</div>
                    </div>
                @endforeach

                <!-- Answer summary -->
                <div class="mt-3 d-flex gap-4">
                    <div>
                        <strong>Correct Answer:</strong>
                        <span class="text-success fw-semibold">
                            {{ $correctAnswer }}
                        </span>
                    </div>

                    <div>
                        <strong>User Answer:</strong>
                        <span class="{{ $userAnswer == $correctAnswer ? 'text-success' : 'text-danger' }} fw-semibold">
                            {{ $userAnswer ?? '-' }}
                        </span>
                    </div>
                </div>

            </div>
        @empty
            <div class="text-center text-muted py-4">
                No questions found
            </div>
        @endforelse

    </div>

    <!-- ================= BACK ================= -->
    <a href="{{ route('user.video.results') }}" class="btn btn-secondary mt-3">
        ← Back to Results
    </a>

</div>
@endsection

@section('script')
<script>
    // Future:
    // - Explanation toggle
    // - Print result
    // - Export PDF
</script>
@endsection
