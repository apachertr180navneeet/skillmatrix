

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-12">
            <h5>
                <span class="text-primary fw-light">SOP</span> Q&A
            </h5>
        </div>
    </div>

    <!-- SOP Card -->
    <div class="card">
        <div class="card-body">

            <!-- SOP Title -->
            <div class="mb-3">
                <label class="fw-bold mb-1">SOP Title</label>
                <div class="sop-title-box">
                    <?php echo e($sop->title ?? 'N/A'); ?>

                </div>
            </div>

            <!-- Total Questions -->
            <div class="total-question">
                Total <?php echo e($sopQuesAns->count()); ?> questions
            </div>

            <!-- Questions & Options -->
            <?php $__empty_1 = true; $__currentLoopData = $sopQuesAns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mt-4">

                    <!-- Question -->
                    <div class="question-title">
                        Q.<?php echo e($index + 1); ?>. <?php echo e($qa->question); ?>

                    </div>

                    <!-- Option 1 -->
                    <div class="option-box <?php echo e($qa->answere_option === '1' ? 'option-correct' : ''); ?>">
                        A. <?php echo e($qa->option_one); ?>

                    </div>

                    <!-- Option 2 -->
                    <div class="option-box <?php echo e($qa->answere_option === '2' ? 'option-correct' : ''); ?>">
                        B. <?php echo e($qa->option_two); ?>

                    </div>

                    <!-- Option 3 -->
                    <div class="option-box <?php echo e($qa->answere_option === '3' ? 'option-correct' : ''); ?>">
                        C. <?php echo e($qa->option_three); ?>

                    </div>

                    <!-- Option 4 -->
                    <div class="option-box <?php echo e($qa->answere_option === '4' ? 'option-correct' : ''); ?>">
                        D. <?php echo e($qa->option_four); ?>

                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-muted mt-3">
                    No questions available for this SOP.
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/sopquesans/index.blade.php ENDPATH**/ ?>