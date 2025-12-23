

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Videos</span>
            </h5>
        </div>
    </div>

    <!-- Video Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="videoTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Party</th>
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

    $('#videoTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "<?php echo e(route('super.admin.video.getall')); ?>",
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

            // company
            {
                data: 'company',
                render: function (data) {
                    return data ? data.name : '-';
                }
            },

            // Action
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/super-admin/video/show/${id}"
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

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/video/index.blade.php ENDPATH**/ ?>