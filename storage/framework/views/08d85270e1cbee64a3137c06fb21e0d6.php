

<?php $__env->startSection('style'); ?>
<style>
    /* ================= CARD ================= */
    .result-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* ================= TABLE ================= */
    .table thead th {
        font-size: 13px;
        font-weight: 600;
        color: #555;
        border-bottom: 1px solid #eaeaea;
        white-space: nowrap;
    }

    .table tbody td {
        font-size: 14px;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* ================= RESULT ================= */
    .result-badge {
        font-weight: 600;
        color: #1e78d6;
    }

    /* ================= BUTTON ================= */
    .btn-view {
        background: #1e78d6;
        color: #fff;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 6px;
        border: none;
    }

    .btn-view:hover {
        background: #155fb1;
        color: #fff;
    }

    /* ================= SEARCH ================= */
    .search-box {
        max-width: 260px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-semibold">Video Results</h5>

        <div class="d-flex gap-2">
            <input type="text" class="form-control search-box" placeholder="Search here...">
            <button class="btn btn-primary px-3">Search</button>
        </div>
    </div>

    <!-- ================= TABLE CARD ================= -->
    <div class="result-card">
        <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th>SR. No.</th>
                        <th>User Name</th>
                        <th>Department</th>
                        <th>Video Title</th>
                        <th>Result Status</th>
                        <th>Result</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $videoUserResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>

                            <td>
                                <?php echo e($row->user->full_name ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($row->user->department->department_name ?? '-'); ?>

                            </td>

                            <td>
                                <?php echo e($row->video->title ?? '-'); ?>

                            </td>

                            <td>
                                <?php if($row->result_status === 'pass'): ?>
                                    <span class="badge bg-success">
                                        Pass
                                    </span>
                                <?php elseif($row->result_status === 'fail'): ?>
                                    <span class="badge bg-danger">
                                        Fail
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        Pending
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <span class="result-badge">
                                    <?php echo e($row->result); ?>%
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="<?php echo e(route('user.video.result.view', $row->id)); ?>"
                                   class="btn btn-view">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No results found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    // Future scope:
    // - AJAX search
    // - Pagination
    // - Filters
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/video_results/index.blade.php ENDPATH**/ ?>