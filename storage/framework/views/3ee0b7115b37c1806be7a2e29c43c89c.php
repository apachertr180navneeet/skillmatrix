

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

<div class="form-card">
<form action="<?php echo e(route('admin.sop.qa.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<!-- SOP TITLE -->
<div class="mb-4">
    <label class="form-label">SOP Title</label>
    <input type="text" class="form-control" value="<?php echo e($sopdetails->title); ?>" readonly>
    <input type="hidden" name="sop_id" value="<?php echo e($sopdetails->id); ?>">
</div>

<!-- QUESTIONS -->
<div id="questionWrapper">

<?php if($sopquesans->count() > 0): ?>

<?php $__currentLoopData = $sopquesans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="question-card" data-index="<?php echo e($qIndex); ?>">

    <div class="d-flex justify-content-between mb-3">
        <label class="form-label">Question <?php echo e($qIndex + 1); ?></label>

        <button type="button"
            class="btn btn-danger btn-sm remove-question <?php echo e($qIndex == 0 ? 'd-none' : ''); ?>">
            Remove
        </button>
    </div>

    <!-- QUESTION -->
    <input type="text"
        name="questions[<?php echo e($qIndex); ?>][question]"
        class="form-control mb-3"
        value="<?php echo e($qa->question); ?>"
        required>

    <!-- OPTION 1 -->
    <div class="option-row">
        <input type="radio"
            name="questions[<?php echo e($qIndex); ?>][correct]"
            value="1"
            <?php echo e($qa->answere_option == 1 ? 'checked' : ''); ?>

            required>

        <input type="text"
            name="questions[<?php echo e($qIndex); ?>][options][1]"
            class="form-control"
            value="<?php echo e($qa->option_one); ?>"
            placeholder="Option 1"
            required>
    </div>

    <!-- OPTION 2 -->
    <div class="option-row">
        <input type="radio"
            name="questions[<?php echo e($qIndex); ?>][correct]"
            value="2"
            <?php echo e($qa->answere_option == 2 ? 'checked' : ''); ?>

            required>

        <input type="text"
            name="questions[<?php echo e($qIndex); ?>][options][2]"
            class="form-control"
            value="<?php echo e($qa->option_two); ?>"
            placeholder="Option 2"
            required>
    </div>

    <!-- OPTION 3 -->
    <div class="option-row">
        <input type="radio"
            name="questions[<?php echo e($qIndex); ?>][correct]"
            value="3"
            <?php echo e($qa->answere_option == 3 ? 'checked' : ''); ?>

            required>

        <input type="text"
            name="questions[<?php echo e($qIndex); ?>][options][3]"
            class="form-control"
            value="<?php echo e($qa->option_three); ?>"
            placeholder="Option 3"
            required>
    </div>

    <!-- OPTION 4 -->
    <div class="option-row">
        <input type="radio"
            name="questions[<?php echo e($qIndex); ?>][correct]"
            value="4"
            <?php echo e($qa->answere_option == 4 ? 'checked' : ''); ?>

            required>

        <input type="text"
            name="questions[<?php echo e($qIndex); ?>][options][4]"
            class="form-control"
            value="<?php echo e($qa->option_four); ?>"
            placeholder="Option 4"
            required>
    </div>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
<!-- DEFAULT QUESTION -->
<div class="question-card" data-index="0">
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

<button type="button" class="btn btn-primary btn-sm mb-3" id="addQuestion">
+ Add Question
</button>

<div class="text-end">
<button type="submit" class="submit-btn">Submit SOP</button>
</div>

</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
let questionIndex = <?php echo e($sopquesans->count() > 0 ? $sopquesans->count() : 1); ?>;

document.getElementById('addQuestion').addEventListener('click', function () {

let wrapper = document.getElementById('questionWrapper');

let html = `
<div class="question-card" data-index="${questionIndex}">
<label class="form-label">Question ${questionIndex + 1}</label>

<input type="text"
name="questions[${questionIndex}][question]"
class="form-control mb-3"
required>

${[1,2,3,4].map(i => `
<div class="option-row">
<input type="radio" name="questions[${questionIndex}][correct]" value="${i}" required>
<input type="text" name="questions[${questionIndex}][options][${i}]"
class="form-control" placeholder="Option ${i}" required>
</div>`).join('')}

<button type="button" class="btn btn-danger btn-sm remove-question mt-2">
Remove
</button>
</div>`;

wrapper.insertAdjacentHTML('beforeend', html);
questionIndex++;
});

document.addEventListener('click', function(e){
if(e.target.classList.contains('remove-question')){
e.target.closest('.question-card').remove();
}
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/sop_quesans/create.blade.php ENDPATH**/ ?>