

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Checklist</span>
            </h5>
        </div>
    </div>

    <!-- Checklist Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="checklistTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Description</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function () {

    $('#checklistTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "<?php echo e(route('super.admin.checklist.getall')); ?>",
        columns: [

            // Title
            { data: 'title' },

            // Department
            {
                data: 'department',
                render: function (data) {
                    return data ? data.department_name : '-';
                }
            },

            // Company
            {
                data: 'company',
                render: function (data) {
                    return data ? data.name : '-';
                }
            },

            // Description (short)
            {
                data: 'description',
                render: function (data) {
                    if (!data) return '-';
                    return data.length > 50
                        ? data.substring(0, 50) + '...'
                        : data;
                }
            },

            // Actions
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/super-admin/checklist/show/${id}"
                           class="btn btn-sm btn-info">
                           View
                        </a>
                    `;
                }
            }
        ]
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/checklist/index.blade.php ENDPATH**/ ?>