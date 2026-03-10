

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Department</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            
        </div>
    </div>

    <!-- SOP Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="sopTable">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Company</th>
                            <th>Status</th>
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

    $('#sopTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "<?php echo e(route('super.admin.departments.getall')); ?>",
        columns: [

            // Department Name
            { data: 'department_name' },

            // Company (relation)
            {
                data: 'company',
                render: function (data) {
                    return data ? data.copmany_name : '-';
                }
            },


            // Status
            {
                data: 'status',
                render: function (data) {
                    return data === 'active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                }
            },
        ]
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/department/index.blade.php ENDPATH**/ ?>