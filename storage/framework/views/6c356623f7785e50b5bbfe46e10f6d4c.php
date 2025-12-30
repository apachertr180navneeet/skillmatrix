

<?php $__env->startSection('style'); ?>
<style>
    .table th {
        font-weight: 600;
        font-size: 13px;
        background: #f8f9fa;
    }

    .table td {
        font-size: 13px;
        vertical-align: middle;
    }

    /* ================= ACTION BUTTONS ================= */
    .action-btns {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .action-btns .btn {
        font-size: 11px;
        padding: 6px 0;
        border-radius: 6px;
        width: 120px;
        text-align: center;
    }

    .action-btns form {
        margin: 0;
    }

    .top-actions {
        display: flex;
        gap: 10px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <input type="text"
                   class="form-control"
                   id="searchInput"
                   placeholder="Search here..."
                   style="width:220px;">
        </div>

        <div class="top-actions">
            <a href="<?php echo e(route('admin.checklist.create')); ?>" class="btn btn-primary">
                + Create
            </a>
        </div>
    </div>

    <!-- ================= FILTER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Checklists</h5>

        <select class="form-select w-auto" id="departmentFilter">
            <option value="">Department</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->id); ?>">
                    <?php echo e($department->department_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- ================= TABLE ================= -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th width="180">Department</th>
                        <th width="380">Action</th>
                    </tr>
                </thead>

                <!-- IMPORTANT ID -->
                <tbody id="checklistTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $checklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>

                            <td>
                                <a href="<?php echo e($checklist->file); ?>"
                                   target="_blank"
                                   class="fw-semibold">
                                    <?php echo e($checklist->title); ?>

                                </a>
                            </td>

                            <td>
                                <?php echo e($checklist->department->department_name ?? '-'); ?>

                            </td>

                            <td>
                                <div class="action-btns">
                                    <a href="<?php echo e(route('admin.checklist.edit', $checklist->id)); ?>"
                                       class="btn btn-warning text-white">
                                        Edit
                                    </a>

                                    <a href="<?php echo e(route('admin.checklist.qa.create', $checklist->id)); ?>"
                                       class="btn btn-info text-white">
                                        Add Ques & Ans
                                    </a>

                                    <form action="<?php echo e(route('admin.checklist.destroy', $checklist->id)); ?>"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this checklist?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-secondary">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Checklists found
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
$(document).ready(function () {

    function loadChecklists() {

        let search = $('#searchInput').val();
        let departmentId = $('#departmentFilter').val();

        $.ajax({
            url: "<?php echo e(route('admin.checklist.filter')); ?>",
            type: "GET",
            data: {
                search: search,
                department_id: departmentId
            },
            beforeSend: function () {
                $('#checklistTableBody').html(`
                    <tr>
                        <td colspan="4" class="text-center">
                            Loading...
                        </td>
                    </tr>
                `);
            },
            success: function (res) {

                let rows = '';

                if (res.data.length > 0) {

                    $.each(res.data, function (index, checklist) {

                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <a href="${checklist.file}"
                                       target="_blank"
                                       class="fw-semibold">
                                        ${checklist.title}
                                    </a>
                                </td>
                                <td>
                                    ${checklist.department ? checklist.department.department_name : '-'}
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="/admin/checklist/edit/${checklist.id}"
                                           class="btn btn-warning text-white">
                                            Edit
                                        </a>

                                        <a href="/admin/checklist/qa/create/${checklist.id}"
                                           class="btn btn-info text-white">
                                            Add Ques & Ans
                                        </a>

                                        <form action="/admin/checklist/${checklist.id}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this checklist?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    class="btn btn-secondary">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });

                } else {

                    rows = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Checklists found
                            </td>
                        </tr>
                    `;
                }

                $('#checklistTableBody').html(rows);
            }
        });
    }

    // 🔍 Search
    $('#searchBtn').on('click', function () {
        loadChecklists();
    });

    $('#searchInput').on('keyup', function () {
        loadChecklists();
    });

    // 🏷️ Department Filter
    $('#departmentFilter').on('change', function () {
        loadChecklists();
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/checklist/index.blade.php ENDPATH**/ ?>