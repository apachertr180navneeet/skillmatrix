

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
.form-label { font-weight: 600; font-size: 14px; }
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid container-p-y">

<!-- IMPORT EXCEL -->
<div class="d-flex justify-content-end mb-3">
    <button type="button"
            class="btn btn-success btn-sm"
            onclick="document.getElementById('excelInput').click()">
        📥 Import Excel
    </button>
</div>

<input type="file" id="excelInput" accept=".xls,.xlsx" hidden>

<div class="form-card">
<form action="<?php echo e(route('admin.video.qa.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<!-- VIDEO TITLE -->
<div class="mb-4">
    <label class="form-label">Video Title</label>
    <input type="text" class="form-control"
           value="<?php echo e($videoDetails->title); ?>" readonly>
    <input type="hidden" name="vedio_id"
           value="<?php echo e($videoDetails->id); ?>">
</div>

<!-- QUESTIONS -->
<div id="questionWrapper">

<?php if($videoQuesAns->count() > 0): ?>
<?php $__currentLoopData = $videoQuesAns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="question-card">

    <div class="d-flex justify-content-between mb-3">
        <label class="form-label">Question <?php echo e($qIndex + 1); ?></label>

        <button type="button"
                class="btn btn-danger btn-sm remove-question <?php echo e($qIndex == 0 && $videoQuesAns->count() == 1 ? 'd-none' : ''); ?>">
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
               value="<?php echo e($qa->{'option_'.['one','two','three','four'][$i-1]}); ?>"
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
Submit Video Questions
</button>
</div>

</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
let questionIndex = <?php echo e($videoQuesAns->count() > 0 ? $videoQuesAns->count() : 1); ?>;

/* ADD QUESTION */
document.getElementById('addQuestion').addEventListener('click', function () {
    addQuestion();
});

function addQuestion(data = null) {

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
               value="${data?.question ?? ''}"
               required>
    `;

    [1,2,3,4].forEach(i => {
        html += `
        <div class="option-row">
            <input type="radio"
                   name="questions[${questionIndex}][correct]"
                   value="${i}"
                   ${data?.correct === i ? 'checked' : ''}
                   required>

            <input type="text"
                   name="questions[${questionIndex}][options][${i}]"
                   class="form-control"
                   value="${data?.options?.[i-1] ?? ''}"
                   required>
        </div>
        `;
    });

    html += `</div>`;

    document.getElementById('questionWrapper')
        .insertAdjacentHTML('beforeend', html);

    questionIndex++;
    updateRemoveButtons();
}

/* REMOVE QUESTION */
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-question')) {
        e.target.closest('.question-card').remove();
        updateRemoveButtons();
    }
});

/* UPDATE REMOVE BUTTON VISIBILITY */
function updateRemoveButtons() {
    const cards = document.querySelectorAll('.question-card');
    cards.forEach((card, index) => {
        const btn = card.querySelector('.remove-question');
        if (btn) {
            btn.style.display = cards.length > 1 ? 'inline-block' : 'none';
        }
    });
}

/* EXCEL IMPORT (SMART FILL) */
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
                addQuestion(data);
            }
        });

        updateRemoveButtons();
        e.target.value = '';
    };

    reader.readAsBinaryString(file);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/video_quesans/create.blade.php ENDPATH**/ ?>