

<?php $__env->startSection('style'); ?>
<style>
    .qa-card {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        max-width: 1000px;
        margin: auto;
    }

    .sop-title-box {
        background: #bfbfbf;
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid container-p-y">

    <div class="qa-card">

        <h4 class="mb-3">SOP Q&amp;A</h4>

        <!-- SOP TITLE -->
        <div class="mb-3">
            <label class="fw-bold mb-1">SOP Title</label>
            <div class="sop-title-box">
                <?php echo e($sopdetails->title); ?>

            </div>
        </div>

        <!-- TOTAL QUESTIONS -->
        <p class="text-danger fw-bold">
            Total <?php echo e($sopquesans->count()); ?> questions
        </p>

        <!-- QUESTIONS -->
        <form action="<?php echo e(route('user.sop.qa.submit')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="sop_id" value="<?php echo e($sopdetails->id); ?>">
            <?php $__currentLoopData = $sopquesans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-4">

                    <!-- QUESTION -->
                    <div class="question-title">
                        Q<?php echo e($index + 1); ?>. <?php echo e($qa->question); ?>

                    </div>

                    <input type="hidden" name="ques_id[]" value="<?php echo e($qa->id); ?>">

                    <!-- OPTION ONE -->
                    <?php if(!empty($qa->option_one)): ?>
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[<?php echo e($qa->id); ?>]"
                                   value="1">
                            <?php echo e($qa->option_one); ?>

                        </label>
                    <?php endif; ?>

                    <!-- OPTION TWO -->
                    <?php if(!empty($qa->option_two)): ?>
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[<?php echo e($qa->id); ?>]"
                                   value="2">
                            <?php echo e($qa->option_two); ?>

                        </label>
                    <?php endif; ?>

                    <!-- OPTION THREE -->
                    <?php if(!empty($qa->option_three)): ?>
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[<?php echo e($qa->id); ?>]"
                                   value="3">
                            <?php echo e($qa->option_three); ?>

                        </label>
                    <?php endif; ?>

                    <!-- OPTION FOUR -->
                    <?php if(!empty($qa->option_four)): ?>
                        <label class="option-box">
                            <input type="radio"
                                   name="answers[<?php echo e($qa->id); ?>]"
                                   value="4">
                            <?php echo e($qa->option_four); ?>

                        </label>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- SUBMIT -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary submit-btn">
                    Submit
                </button>
            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/sop/qa.blade.php ENDPATH**/ ?>