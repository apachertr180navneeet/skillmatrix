@extends('admin.layouts.app')

@section('style')
<style>
    /* ================= RESULT CARD ================= */
    .result-card {
        background: #fff;
        border-radius: 22px;
        padding: 22px 28px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    .summary-card {
        padding-top: 24px;
        padding-bottom: 24px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px 60px;
    }

    .summary-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    .summary-item {
        min-width: 0;
    }

    .summary-label {
        margin-bottom: 6px;
        font-size: 16px;
        font-weight: 700;
        color: #667d99;
        line-height: 1.2;
    }

    .summary-value {
        font-size: 14px;
        font-weight: 600;
        color: #a5b0bf;
        line-height: 1.4;
        word-break: break-word;
    }

    .summary-value--strong {
        color: #5c6d82;
        font-size: 15px;
    }

    .summary-value--success {
        color: #6bd14b;
    }

    .summary-value--danger {
        color: #ff5838;
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

    .option-correct {
        background: #e6f4ea;
        border-color: #198754;
        color: #198754;
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

    .option-correct .option-label { background: #198754; color: #fff; }
    .option-wrong .option-label   { background: #dc3545; color: #fff; }

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

    @media (max-width: 991.98px) {
        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 24px;
        }
    }

    @media (max-width: 575.98px) {
        .result-card {
            padding: 20px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= HEADER ================= -->
    <div class="result-header">
        <h5 class="mb-0 fw-semibold">Video Result Details</h5>

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
    <div class="result-card summary-card mb-4">
        <div class="summary-grid">
            <div class="summary-column">
                <div class="summary-item">
                    <div class="summary-label">Video Title</div>
                    <div class="summary-value">{{ $result->video->title ?? '-' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Total Questions</div>
                    <div class="summary-value summary-value--strong">{{ $result->total_questions }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Status</div>
                    <div>
                        <span class="badge {{ $result->result_status === 'pass' ? 'badge-pass' : 'badge-fail' }}">
                            {{ strtoupper($result->result_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="summary-column">
                <div class="summary-item">
                    <div class="summary-label">User Name</div>
                    <div class="summary-value">{{ $result->user->full_name ?? '-' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Correct</div>
                    <div class="summary-value summary-value--strong summary-value--success">{{ $result->correct_answers }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Attempt Date</div>
                    <div class="summary-value">{{ $result->created_at->format('d M Y, h:i A') }}</div>
                </div>
            </div>

            <div class="summary-column">
                <div class="summary-item">
                    <div class="summary-label">Email</div>
                    <div class="summary-value">{{ $result->user->email ?? '-' }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Wrong</div>
                    <div class="summary-value summary-value--strong summary-value--danger">{{ $result->wrong_answers }}</div>
                </div>

                <div class="summary-item">
                    <div class="summary-label">Score</div>
                    <div class="summary-value summary-value--strong">{{ $result->result }}%</div>
                </div>
            </div>
        </div>
    </div>


    <!-- ================= QUESTIONS ================= -->
    <div class="mt-4">

        @forelse($questiondeatil as $index => $question)
            <div class="result-card">

                <div class="question-title">
                    Q{{ $index + 1 }}. {{ $question['question'] }}
                </div>

                @php
                    $correctAnswer = $question['correct_answer'];
                    $userAnswer    = $question['user_answer'];
                @endphp

                @foreach($question['options'] as $key => $option)
                    @php
                        $class = '';

                        if ($key == $correctAnswer) {
                            $class = 'option-correct';
                        }

                        if ($key == $userAnswer && $userAnswer != $correctAnswer) {
                            $class = 'option-wrong';
                        }
                    @endphp

                    <div class="option-box {{ $class }}">
                        <div class="option-label">{{ $key }}</div>
                        <div>{{ $option }}</div>
                    </div>
                @endforeach

                <!-- ================= ANSWER SUMMARY ================= -->
                <div class="mt-3 d-flex gap-4">
                    <div>
                        <strong>Correct Answer:</strong>
                        <span class="text-success fw-semibold">
                            Option {{ $correctAnswer }}
                        </span>
                    </div>

                    <div>
                        <strong>User Answer:</strong>
                        <span class="{{ $userAnswer == $correctAnswer ? 'text-success' : 'text-danger' }} fw-semibold">
                            {{ $userAnswer ? 'Option '.$userAnswer : '-' }}
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
    <a href="{{ route('company.video.result.index') }}" class="btn btn-secondary mt-3">
        Back to Results
    </a>

</div>
@endsection

@section('script')
<script>
    // Future Enhancements:
    // - Explanation toggle
    // - Print / PDF export
    // - Answer filtering
</script>
@endsection
