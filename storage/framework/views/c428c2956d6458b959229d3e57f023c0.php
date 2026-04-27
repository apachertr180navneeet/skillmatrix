

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
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Suggestion</th>
                            <th>Status</th>
                            <th>Created At</th>
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

            // S.No
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },

            // SOP Title
            { data: 'title' },

            // Department
            {
                data: 'department_names',
                render: function (data) {
                    return data ? data : '-';
                }
            },

            // Company
            {
                data: 'company',
                render: function (data) {
                    return data ? data.copmany_name : '-';
                }
            },

            // Suggestion
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

            // Created At
            {
                data: 'created_at',
                render: function (data) {
                    if (!data) return '-';
                    let date = new Date(data);
                    return date.toLocaleDateString('en-IN');
                }
            },

            // Action
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/master/sop/show/${id}" class="btn btn-sm btn-info me-1">
                            View
                        </a>

                        <a href="/master/sop/${id}/qa" class="btn btn-sm btn-secondary">
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

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/sop/index.blade.php ENDPATH**/ ?>