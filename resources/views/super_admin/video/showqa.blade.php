@extends('super_admin.layouts.app')

@section('style')
<style>
    .sop-title-box {
        background-color: #b3b3b3;
        color: #fff;
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 600;
    }

    .question-title {
        font-weight: 600;
        margin-top: 20px;
    }

    .option-box {
        background-color: #f5f5f5;
        padding: 10px 15px;
        border-radius: 6px;
        margin-top: 6px;
        color: #444;
    }

    .option-correct {
        background-color: #d4edda;
        border-left: 5px solid #28a745;
        font-weight: 600;
        color: #155724;
    }

    .total-question {
        color: red;
        font-weight: 600;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-12">
            <h5>
                <span class="text-primary fw-light">Video</span> Q&A
            </h5>
        </div>
    </div>

    <!-- SOP Card -->
    <div class="card">
        <div class="card-body">

            <!-- SOP Title -->
            <div class="mb-3">
                <label class="fw-bold mb-1">Video Title</label>
                <div class="sop-title-box">
                    {{ $video->title ?? 'N/A' }}
                </div>
            </div>

            <!-- Total Questions -->
            <div class="total-question">
                Total {{ $videoQUesAns->count() }} questions
            </div>

            <!-- Questions & Options -->
            @forelse ($videoQUesAns as $index => $qa)
                <div class="mt-4">

                    <!-- Question -->
                    <div class="question-title">
                        Q.{{ $index + 1 }}. {{ $qa->question }}
                    </div>

                    <!-- Option 1 -->
                    <div class="option-box {{ $qa->answere_option === '1' ? 'option-correct' : '' }}">
                        A. {{ $qa->option_one }}
                    </div>

                    <!-- Option 2 -->
                    <div class="option-box {{ $qa->answere_option === '2' ? 'option-correct' : '' }}">
                        B. {{ $qa->option_two }}
                    </div>

                    <!-- Option 3 -->
                    <div class="option-box {{ $qa->answere_option === '3' ? 'option-correct' : '' }}">
                        C. {{ $qa->option_three }}
                    </div>

                    <!-- Option 4 -->
                    <div class="option-box {{ $qa->answere_option === '4' ? 'option-correct' : '' }}">
                        D. {{ $qa->option_four }}
                    </div>

                </div>
            @empty
                <div class="text-muted mt-3">
                    No questions available for this Video.
                </div>
            @endforelse

        </div>
    </div>

</div>
@endsection

@section('script')
@endsection
