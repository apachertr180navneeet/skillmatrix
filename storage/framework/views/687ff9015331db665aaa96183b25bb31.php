

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
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Party</th>
                            <th>Created At</th>
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

            // S.No.
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },

            // Title
            { data: 'title' },

            // Department
            {
                data: 'department_names',
                render: function (data) {
                    return data ? data : '-';
                }
            },

            // Company / Party
            {
                data: 'company',
                render: function (data) {
                    return data ? data.copmany_name : '-';
                }
            },

            // Created At
            {
                data: 'created_at',
                render: function (data) {
                    if (!data) return '-';
                    let date = new Date(data);
                    return date.toLocaleDateString('en-IN') + ' ' +
                           date.toLocaleTimeString('en-IN');
                }
            },

            // Action
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <a href="/master/video/show/${id}"
                           class="btn btn-sm btn-info">
                           View
                        </a>

                        <a href="/master/video/${id}/qa" class="btn btn-sm btn-secondary">
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

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/video/index.blade.php ENDPATH**/ ?>