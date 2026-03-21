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
    .import-toolbar {
        max-width: 900px;
        margin: 0 auto 18px;
        padding: 14px 18px;
        background: linear-gradient(135deg, #f7fbff 0%, #eef6ff 100%);
        border: 1px solid #d7e7fb;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }
    .import-toolbar__text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .import-toolbar__label {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #163a63;
    }
    .import-toolbar__hint {
        margin: 0;
        font-size: 13px;
        color: #5f6f82;
    }
    .import-toolbar__actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .sample-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 0 16px;
        border: 1px solid #c7daf3;
        border-radius: 10px;
        background: #fff;
        color: #1e5ea8;
        font-weight: 600;
        text-decoration: none;
    }
    .sample-link:hover {
        color: #174b86;
        background: #f7fbff;
        text-decoration: none;
    }
    .import-btn {
        min-height: 42px;
        padding: 0 18px;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
    }
    @media (max-width: 576px) {
        .import-toolbar,
        .import-toolbar__actions {
            align-items: stretch;
        }
        .sample-link,
        .import-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid container-p-y">

    <!-- IMPORT EXCEL -->
    <div class="import-toolbar">
        <div class="import-toolbar__text">
            <p class="import-toolbar__label">Bulk upload checklist questions</p>
            <p class="import-toolbar__hint">Import an Excel file to add checklist questions in one step.</p>
        </div>
        <div class="import-toolbar__actions">
            <a href="{{ asset('assets/sop_sample_questions.xlsx') }}"
               class="sample-link"
               target="_blank"
               rel="noopener">
                Download Sample
            </a>
            <button type="button"
                    class="btn btn-success import-btn"
                    onclick="document.getElementById('excelInput').click()">
                &#128229; Import Excel
            </button>
        </div>
    </div>

    <input type="file" id="excelInput" accept=".xls,.xlsx" hidden>

    <div class="form-card">
        <form action="{{ route('admin.checklist.qa.store') }}" method="POST">
            @csrf

            @php
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
                <input type="text"
                       class="form-control"
                       value="{{ $checklistdetails->title }}"
                       readonly>
                <input type="hidden"
                       name="checklist_id"
                       value="{{ $checklistdetails->id }}">
            </div>

            <!-- QUESTIONS -->
            <div id="questionWrapper">

                @if($checklistquesans->count() > 0)
                    @foreach($checklistquesans as $qIndex => $qa)
                        <div class="question-card">

                            <div class="d-flex justify-content-between mb-3">
                                <label class="form-label">
                                    Question {{ $qIndex + 1 }}
                                </label>

                                <button type="button"
                                        class="btn btn-danger btn-sm remove-question {{ $qIndex == 0 && $checklistquesans->count() == 1 ? 'd-none' : '' }}">
                                    Remove
                                </button>
                            </div>

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
                                           {{ $qa->answer_option == $i ? 'checked' : '' }}
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
                    <!-- DEFAULT EMPTY QUESTION -->
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

@section('script')

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
let questionIndex = {{ $checklistquesans->count() > 0 ? $checklistquesans->count() : 1 }};

/* UPDATE REMOVE BUTTON */
function updateRemoveButtons() {
    const cards = document.querySelectorAll('.question-card');
    cards.forEach((card, index) => {
        const btn = card.querySelector('.remove-question');
        if (btn) {
            btn.style.display = cards.length > 1 ? 'inline-block' : 'none';
        }
    });
}

/* REMOVE QUESTION */
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-question')) {
        e.target.closest('.question-card').remove();
        updateRemoveButtons();
    }
});

/* SMART EXCEL IMPORT */
document.getElementById('excelInput').addEventListener('change', function (e) {

    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (evt) {

        const wb = XLSX.read(evt.target.result, { type: 'binary' });
        const sheet = wb.Sheets[wb.SheetNames[0]];
        const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        rows.shift(); // header

        rows.forEach((row, index) => {

            if (!row[0]) return;

            const data = {
                question: row[0],
                options: [row[1], row[2], row[3], row[4]],
                correct: parseInt(row[5])
            };

            const firstQuestionInput = document.querySelector(
                'input[name="questions[0][question]"]'
            );

            // ✅ Fill first empty question
            if (index === 0 && firstQuestionInput && firstQuestionInput.value.trim() === '') {

                firstQuestionInput.value = data.question;

                data.options.forEach((opt, i) => {
                    document.querySelector(
                        `input[name="questions[0][options][${i+1}]"]`
                    ).value = opt ?? '';

                    if (data.correct === i + 1) {
                        document.querySelector(
                            `input[name="questions[0][correct]"][value="${i+1}"]`
                        ).checked = true;
                    }
                });

            } else {

                // ✅ Append new question
                let html = `
                <div class="question-card">
                    <div class="d-flex justify-content-between mb-3">
                        <label class="form-label">Question ${questionIndex + 1}</label>
                        <button type="button"
                                class="btn btn-danger btn-sm remove-question">
                            Remove
                        </button>
                    </div>

                    <input type="text"
                           name="questions[${questionIndex}][question]"
                           class="form-control mb-3"
                           value="${data.question}"
                           required>
                `;

                data.options.forEach((opt, i) => {
                    html += `
                    <div class="option-row">
                        <input type="radio"
                               name="questions[${questionIndex}][correct]"
                               value="${i+1}"
                               ${data.correct === i+1 ? 'checked' : ''}
                               required>

                        <input type="text"
                               name="questions[${questionIndex}][options][${i+1}]"
                               class="form-control"
                               value="${opt ?? ''}"
                               required>
                    </div>
                    `;
                });

                html += `</div>`;

                document.getElementById('questionWrapper')
                    .insertAdjacentHTML('beforeend', html);

                questionIndex++;
            }
        });

        updateRemoveButtons();
        e.target.value = '';
    };

    reader.readAsBinaryString(file);
});
</script>
@endsection
