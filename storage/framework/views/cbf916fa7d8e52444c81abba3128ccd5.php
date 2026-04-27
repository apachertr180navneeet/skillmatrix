<?php $__env->startSection('style'); ?>
<style>
    .result-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .result-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 12px 32px rgba(15, 23, 42, 0.06);
        margin-bottom: 20px;
    }

    .summary-card {
        padding: 0;
        overflow: hidden;
    }

    .summary-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 24px;
        background: linear-gradient(135deg, #f8fbff 0%, #eef5ff 100%);
        border-bottom: 1px solid #e9edf5;
    }

    .summary-title {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
    }

    .summary-subtitle {
        margin-top: 6px;
        color: #6b7280;
        font-size: 0.95rem;
        word-break: break-word;
    }

    .summary-score {
        min-width: 140px;
        text-align: right;
    }

    .summary-score-label {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #6b7280;
    }

    .summary-score-value {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        line-height: 1;
        font-weight: 800;
        color: #111827;
        margin-top: 6px;
    }

    .summary-body {
        padding: 24px;
    }

    .info-grid,
    .stats-grid {
        display: grid;
        gap: 16px;
    }

    .info-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-bottom: 20px;
    }

    .stats-grid {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }

    .info-item,
    .stat-item {
        background: #fff;
        border: 1px solid #edf1f7;
        border-radius: 16px;
        padding: 16px 18px;
        min-width: 0;
    }

    .info-label,
    .stat-label {
        display: block;
        margin-bottom: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: #6b7280;
    }

    .info-value,
    .stat-value {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        word-break: break-word;
    }

    .question-card {
        padding: 0;
        overflow: hidden;
    }

    .question-card-header {
        padding: 20px 24px 14px;
        border-bottom: 1px solid #edf1f7;
        background: #fcfdff;
    }

    .question-title {
        font-weight: 700;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
        color: #1f2937;
    }

    .question-card-body {
        padding: 18px 24px 24px;
    }

    .option-list {
        display: grid;
        gap: 10px;
    }

    .option-box {
        border-radius: 14px;
        padding: 14px 16px;
        font-size: 14px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #f9fafb;
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
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .option-text {
        flex: 1;
        min-width: 0;
        line-height: 1.6;
        word-break: break-word;
    }

    .option-correct .option-label { background: #198754; color: #fff; }
    .option-wrong .option-label { background: #dc3545; color: #fff; }

    .result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .result-header-left h5 {
        font-size: clamp(1.35rem, 2vw, 1.75rem);
        color: #111827;
    }

    .result-header-left p {
        margin: 6px 0 0;
        color: #6b7280;
    }

    .result-header-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .badge-pass {
        background: #e6f4ea;
        color: #198754;
        font-weight: 600;
        border: 1px solid rgba(25, 135, 84, 0.18);
    }

    .badge-fail {
        background: #fdecea;
        color: #dc3545;
        font-weight: 600;
        border: 1px solid rgba(220, 53, 69, 0.18);
    }

    .status-badge {
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 0.85rem;
    }

    .score-pill {
        border-radius: 999px;
        background: #111827;
        color: #fff;
        padding: 8px 14px;
        font-size: 0.9rem;
        font-weight: 700;
    }

    .answer-summary {
        margin-top: 18px;
        padding-top: 18px;
        border-top: 1px solid #edf1f7;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .answer-summary-item {
        background: #f8fafc;
        border: 1px solid #edf1f7;
        border-radius: 14px;
        padding: 14px 16px;
    }

    .answer-summary-label {
        display: block;
        margin-bottom: 6px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: #6b7280;
    }

    .answer-summary-value {
        display: block;
        font-size: 0.98rem;
        font-weight: 700;
    }

    .result-actions {
        margin-top: 24px;
    }

    .result-actions .btn {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }

    @media (max-width: 991.98px) {
        .info-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .stats-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .result-card {
            border-radius: 18px;
            padding: 18px;
        }

        .summary-card,
        .question-card {
            padding: 0;
        }

        .summary-top,
        .summary-body,
        .question-card-header,
        .question-card-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .summary-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .summary-score {
            min-width: 0;
            text-align: left;
        }

        .info-grid,
        .stats-grid,
        .answer-summary {
            grid-template-columns: 1fr;
        }

        .result-header {
            align-items: flex-start;
        }

        .result-header-right {
            width: 100%;
        }
    }

    @media (max-width: 575.98px) {
        .container-p-y {
            padding-left: 12px;
            padding-right: 12px;
        }

        .result-card {
            margin-bottom: 16px;
        }

        .option-box {
            padding: 12px 14px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="result-page">

    <div class="result-header">
        <div class="result-header-left">
            <h5 class="mb-0 fw-semibold">Video Result Details</h5>
            <p>Review the score, attempt summary, and question-wise answers.</p>
        </div>

        <div class="result-header-right">
            <span class="badge status-badge <?php echo e($result->result_status === 'pass' ? 'badge-pass' : 'badge-fail'); ?>">
                <?php echo e(ucfirst($result->result_status)); ?>

            </span>
            <span class="score-pill">
                <?php echo e($result->result); ?>%
            </span>
        </div>
    </div>

    <div class="result-card summary-card mb-4">
        <div class="summary-body">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Video Title</span>
                    <span class="info-value"><?php echo e($result->video->title ?? '-'); ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">User Name</span>
                    <span class="info-value"><?php echo e($result->user->full_name ?? '-'); ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?php echo e($result->user->email ?? '-'); ?></span>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-label">Total Questions</span>
                    <span class="stat-value"><?php echo e($result->total_questions); ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Correct</span>
                    <span class="stat-value text-success"><?php echo e($result->correct_answers); ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Wrong</span>
                    <span class="stat-value text-danger"><?php echo e($result->wrong_answers); ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Status</span>
                    <span class="stat-value"><?php echo e(ucfirst($result->result_status)); ?></span>
                </div>

                <div class="stat-item">
                    <span class="stat-label">Attempt Date</span>
                    <span class="stat-value"><?php echo e($result->created_at->format('d M Y, h:i A')); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <?php $__empty_1 = true; $__currentLoopData = $questiondeatil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="result-card question-card">
                <div class="question-card-header">
                    <div class="question-title">
                        Q<?php echo e($index + 1); ?>. <?php echo e($question['question']); ?>

                    </div>
                </div>

                <div class="question-card-body">
                    <?php
                        $correctAnswer = $question['correct_answer'];
                        $userAnswer = $question['user_answer'];
                    ?>

                    <div class="option-list">
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
                                <div class="option-text"><?php echo e($option); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="answer-summary">
                        <div class="answer-summary-item">
                            <span class="answer-summary-label">Correct Answer</span>
                            <span class="answer-summary-value text-success">
                                Option <?php echo e($correctAnswer); ?>

                            </span>
                        </div>

                        <div class="answer-summary-item">
                            <span class="answer-summary-label">User Answer</span>
                            <span class="answer-summary-value <?php echo e($userAnswer == $correctAnswer ? 'text-success' : 'text-danger'); ?>">
                                <?php echo e($userAnswer ? 'Option '.$userAnswer : '-'); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-muted py-4">
                No questions found
            </div>
        <?php endif; ?>
    </div>

    <div class="result-actions">
        <a href="<?php echo e(route('company.video.result.index')); ?>" class="btn btn-secondary">
            Back to Results
        </a>
    </div>

    </div>
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

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/web/video_results/view.blade.php ENDPATH**/ ?>