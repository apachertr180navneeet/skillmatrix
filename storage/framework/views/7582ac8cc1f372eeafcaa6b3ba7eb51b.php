

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
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid container-p-y">

<div class="form-card">
<form action="<?php echo e(route('admin.checklist.qa.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<?php
    // 🔑 EXACT DB FIELD MAP
    $optionMap = [
        1 => 'option_one',
        2 => 'option_two',
        3 => 'option_three',
        4 => 'option_four',
    ];
?>

<!-- CHECKLIST TITLE -->
<div class="mb-4">
    <label class="form-label">Checklist Title</label>
    <input type="text" class="form-control" value="<?php echo e($checklistdetails->title); ?>" readonly>
    <input type="hidden" name="checklist_id" value="<?php echo e($checklistdetails->id); ?>">
</div>

<!-- QUESTIONS -->
<div id="questionWrapper">

<?php if($checklistquesans->count() > 0): ?>

<?php $__currentLoopData = $checklistquesans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIndex => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="question-card">

    <label class="form-label">Question <?php echo e($qIndex + 1); ?></label>

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
            <?php echo e($qa->answer_option === $optionMap[$i] ? 'checked' : ''); ?>

            required>

        <input type="text"
            name="questions[<?php echo e($qIndex); ?>][options][<?php echo e($i); ?>]"
            class="form-control"
            value="<?php echo e($qa->{$optionMap[$i]}); ?>"
            required>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
<!-- DEFAULT QUESTION -->
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

<div class="text-end">
<button type="submit" class="submit-btn">
Save Checklist Q&A
</button>
</div>

</form>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/checklist_quesans/create.blade.php ENDPATH**/ ?>