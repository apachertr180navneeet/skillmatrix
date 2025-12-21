

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">SOP</span>
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
                            <th>Title</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Suggestion</th>
                            <th>Status</th>
                            <th width="200">Action</th>
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
        ajax: "<?php echo e(route('super.admin.sop.getall')); ?>",
        columns: [

            // SOP Title
            { data: 'title' },

            // Department (relation)
            {
                data: 'department',
                render: function (data) {
                    return data ? data.department_name : '-';
                }
            },

            // Company (relation)
            {
                data: 'company',
                render: function (data) {
                    return data ? data.name : '-';
                }
            },

            // is_suggestion
            {
                data: 'is_suggestion',
                render: function (data) {
                    return data === '1'
                        ? '<span class="badge bg-success">Suggestion</span>'
                        : '<span class="badge bg-secondary">No Suggestion</span>';
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

            // Action Buttons (ONLY View & Q&A)
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/super-admin/sop/show/${id}"
                           class="btn btn-sm btn-info me-1">
                           View
                        </a>

                        <a href="/super-admin/sopquesans/${id}/qa"
                           class="btn btn-sm btn-secondary">
                           Q&A
                        </a>
                    `;
                }
            }
        ]
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/sop/index.blade.php ENDPATH**/ ?>