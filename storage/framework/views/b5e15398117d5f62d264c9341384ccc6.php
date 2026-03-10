

<?php $__env->startSection('style'); ?>
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
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= HEADER ================= -->
    <div class="result-header">
        <h5 class="mb-0 fw-semibold">Checklist Result Details</h5>

        <div>
            <span class="badge <?php echo e($result->result_status === 'pass' ? 'badge-pass' : 'badge-fail'); ?>">
                <?php echo e(ucfirst($result->result_status)); ?>

            </span>
            <span class="ms-2 fw-semibold">
                <?php echo e($result->result); ?>%
            </span>
        </div>
    </div>

    <!-- ================= SUMMARY ================= -->
    <div class="result-card mb-4">
        <div class="row g-3">

            <div class="col-md-4">
                <strong>Checklist Title</strong><br>
                <span class="text-muted"><?php echo e($result->checklist->title ?? '-'); ?></span>
            </div>

            <div class="col-md-4">
                <strong>User Name</strong><br>
                <span class="text-muted"><?php echo e($result->user->full_name ?? '-'); ?></span>
            </div>

            <div class="col-md-4">
                <strong>Email</strong><br>
                <span class="text-muted"><?php echo e($result->user->email ?? '-'); ?></span>
            </div>

            <div class="col-md-3">
                <strong>Total Questions</strong><br>
                <span class="fw-semibold"><?php echo e($result->total_questions); ?></span>
            </div>

            <div class="col-md-3">
                <strong>Correct</strong><br>
                <span class="fw-semibold text-success"><?php echo e($result->correct_answers); ?></span>
            </div>

            <div class="col-md-3">
                <strong>Wrong</strong><br>
                <span class="fw-semibold text-danger"><?php echo e($result->wrong_answers); ?></span>
            </div>

            <div class="col-md-3">
                <strong>Score</strong><br>
                <span class="fw-semibold"><?php echo e($result->result); ?>%</span>
            </div>

            <div class="col-md-3">
                <strong>Status</strong><br>
                <span class="badge <?php echo e($result->result_status === 'pass' ? 'badge-pass' : 'badge-fail'); ?>">
                    <?php echo e(ucfirst($result->result_status)); ?>

                </span>
            </div>

            <div class="col-md-3">
                <strong>Attempt Date</strong><br>
                <span class="text-muted">
                    <?php echo e($result->created_at->format('d M Y, h:i A')); ?>

                </span>
            </div>

        </div>
    </div>

    <!-- ================= QUESTIONS ================= -->
    <div class="mt-4">

        <?php $__empty_1 = true; $__currentLoopData = $questiondeatil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="result-card">

                <div class="question-title">
                    Q<?php echo e($index + 1); ?>. <?php echo e($question['question']); ?>

                </div>

                <?php
                    $correctAnswer = $question['correct_answer'];
                    $userAnswer    = $question['user_answer'];
                ?>

                <?php $__currentLoopData = $question['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $class = '';

                        if ($key == $correctAnswer) {
                            $class = 'option-correct';
                        }

                        if ($key == $userAnswer && $userAnswer != $correctAnswer) {
                            $class = 'option-wrong';
                        }
                    ?>

                    <div class="option-box <?php echo e($class); ?>">
                        <div class="option-label"><?php echo e($key); ?></div>
                        <div><?php echo e($option); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- ================= ANSWER SUMMARY ================= -->
                <div class="mt-3 d-flex gap-4">
                    <div>
                        <strong>Correct Answer:</strong>
                        <span class="text-success fw-semibold">
                            Option <?php echo e($correctAnswer); ?>

                        </span>
                    </div>

                    <div>
                        <strong>User Answer:</strong>
                        <span class="<?php echo e($userAnswer == $correctAnswer ? 'text-success' : 'text-danger'); ?> fw-semibold">
                            <?php echo e($userAnswer ? 'Option '.$userAnswer : '-'); ?>

                        </span>
                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-muted py-4">
                No questions found
            </div>
        <?php endif; ?>

    </div>

    <!-- ================= BACK ================= -->
    <a href="<?php echo e(route('admin.checklist.result.index')); ?>" class="btn btn-secondary mt-3">
        ← Back to Results
    </a>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // Future Enhancements:
    // - Explanation toggle
    // - Print / PDF export
    // - Answer filtering
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/checklist_results/view.blade.php ENDPATH**/ ?>