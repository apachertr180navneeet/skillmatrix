

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid container-p-y">

    <!-- IMPORT EXCEL -->
    <div class="import-toolbar">
        <div class="import-toolbar__text">
            <p class="import-toolbar__label">Bulk upload SOP questions</p>
            <p class="import-toolbar__hint">Download the sample sheet, complete it, then import the Excel file here.</p>
        </div>
        <div class="import-toolbar__actions">
            <a href="https://www.precureskill.com/public/assets/sop_sample_questions.xlsx"
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
        <form action="<?php echo e(route('company.sop.qa.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- SOP TITLE -->
            <div class="mb-4">
                <label class="form-label">SOP Title</label>
                <input type="text"
                       class="form-control"
                       value="<?php echo e($sopdetails->title); ?>"
                       readonly>
                <input type="hidden"
                       name="sop_id"
                       value="<?php echo e($sopdetails->id); ?>">
            </div>

            <!-- QUESTIONS -->
            <div id="questionWrapper">

                <?php if($sopquesans->count() > 0): ?>
                    <?php $__currentLoopData = $sopquesans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="question-card">

                            <div class="d-flex justify-content-between mb-3">
                                <label class="form-label">
                                    Question <?php echo e($qIndex + 1); ?>

                                </label>

                                <button type="button"
                                        class="btn btn-danger btn-sm remove-question <?php echo e($qIndex == 0 && $sopquesans->count() == 1 ? 'd-none' : ''); ?>">
                                    Remove
                                </button>
                            </div>

                            <input type="text"
                                   name="questions[<?php echo e($qIndex); ?>][question]"
                                   class="form-control mb-3"
                                   value="<?php echo e($qa->question); ?>"
                                   required>

                            <?php $__currentLoopData = [1,2,3,4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="option-row">
                                    <input type="radio"
                                           name="questions[<?php echo e($qIndex); ?>][correct]"
                                           value="<?php echo e($i); ?>"
                                           <?php echo e($qa->answere_option == $i ? 'checked' : ''); ?>

                                           required>

                                    <input type="text"
                                           name="questions[<?php echo e($qIndex); ?>][options][<?php echo e($i); ?>]"
                                           class="form-control"
                                           value="<?php echo e($qa->{'option_' . ['one','two','three','four'][$i-1]}); ?>"
                                           required>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <!-- DEFAULT EMPTY QUESTION -->
                    <div class="question-card">
                        <label class="form-label">Question 1</label>

                        <input type="text"
                               name="questions[0][question]"
                               class="form-control mb-3"
                               placeholder="Enter question"
                               required>

                        <?php $__currentLoopData = [1,2,3,4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="option-row">
                                <input type="radio"
                                       name="questions[0][correct]"
                                       value="<?php echo e($i); ?>"
                                       required>

                                <input type="text"
                                       name="questions[0][options][<?php echo e($i); ?>]"
                                       class="form-control"
                                       placeholder="Option <?php echo e($i); ?>"
                                       required>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

            </div>

            <button type="button"
                    class="btn btn-primary btn-sm mb-3"
                    id="addQuestion">
                + Add Question
            </button>

            <div class="text-end">
                <button type="submit" class="submit-btn">
                    Submit SOP
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
let questionIndex = <?php echo e($sopquesans->count() > 0 ? $sopquesans->count() : 1); ?>;

/* UPDATE REMOVE BUTTON */
function updateRemoveButtons() {
    const cards = document.querySelectorAll('.question-card');
    cards.forEach(card => {
        const btn = card.querySelector('.remove-question');
        if (btn) btn.style.display = cards.length > 1 ? 'inline-block' : 'none';
    });
}

/* ADD QUESTION (UNCHANGED) */
document.getElementById('addQuestion').addEventListener('click', function () {

    let html = `
    <div class="question-card">
        <div class="d-flex justify-content-between mb-3">
            <label class="form-label">Question ${questionIndex + 1}</label>
            <button type="button" class="btn btn-danger btn-sm remove-question">
                Remove
            </button>
        </div>

        <input type="text"
               name="questions[${questionIndex}][question]"
               class="form-control mb-3"
               required>
    `;

    [1,2,3,4].forEach(i => {
        html += `
        <div class="option-row">
            <input type="radio"
                   name="questions[${questionIndex}][correct]"
                   value="${i}"
                   required>

            <input type="text"
                   name="questions[${questionIndex}][options][${i}]"
                   class="form-control"
                   required>
        </div>
        `;
    });

    html += `</div>`;

    document.getElementById('questionWrapper')
        .insertAdjacentHTML('beforeend', html);

    questionIndex++;
    updateRemoveButtons();
});

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

        rows.shift();

        rows.forEach((row, index) => {

            if (!row[0]) return;

            const data = {
                question: row[0],
                options: [row[1], row[2], row[3], row[4]],
                correct: parseInt(row[5])
            };

            const firstQ = document.querySelector('input[name="questions[0][question]"]');

            if (index === 0 && firstQ && firstQ.value.trim() === '') {

                firstQ.value = data.question;

                data.options.forEach((opt, i) => {
                    document.querySelector(`input[name="questions[0][options][${i+1}]"]`).value = opt ?? '';
                    if (data.correct === i + 1) {
                        document.querySelector(`input[name="questions[0][correct]"][value="${i+1}"]`).checked = true;
                    }
                });

            } else {

                let html = `
                <div class="question-card">
                    <div class="d-flex justify-content-between mb-3">
                        <label class="form-label">Question ${questionIndex + 1}</label>
                        <button type="button" class="btn btn-danger btn-sm remove-question">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/sop_quesans/create.blade.php ENDPATH**/ ?>