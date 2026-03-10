

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-4">
            <h5><span class="text-primary fw-light">Department</span> Management</h5>
        </div>
        <div class="col-md-8 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Department
            </button>
            <button class="btn btn-danger" id="bulkDelete">
                Delete Selected
            </button>

            <button class="btn btn-success" id="bulkActive">
                Set Active
            </button>

            <button class="btn btn-secondary" id="bulkInactive">
                Set Inactive
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="departmentTable">
                    <thead>
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Department Name</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text" id="department_name" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddDepartment">Save</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editid">

                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text" id="edit_department_name" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="EditDepartment">Update</button>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function () {

    const table = $('#departmentTable').DataTable({
        processing: true,
        ajax: "<?php echo e(route('admin.departments.getall')); ?>",
        columns: [
            {
                data: 'id',
                render: function (id) {
                    return `<input type="checkbox" class="rowCheckbox" value="${id}">`;
                },
                orderable: false
            },
            { data: 'department_name' },
            {
                data: 'status',
                render: function (data, type, row) {
                    let checked = data === 'active' ? 'checked' : '';
                    return `
                        <div class="form-check form-switch">
                            <input class="form-check-input changeStatus"
                                   type="checkbox"
                                   data-id="${row.id}"
                                   ${checked}>
                        </div>
                    `;
                }
            },
            {
                data: 'id',
                render: function (id) {
                    return `
                        <button class="btn btn-sm btn-warning" onclick="editDepartment(${id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteDepartment(${id})">Delete</button>
                    `;
                }
            }
        ]
    });


    /* ================= ADD ================= */
    $('#AddDepartment').click(function () {

        $.post("<?php echo e(route('admin.departments.store')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            department_name: $('#department_name').val()
        }, function (res) {
            if (res.success) {
                $('#addModal').modal('hide');
                $('#department_name').val('');
                table.ajax.reload(null, false);

                Toast.fire({ icon: 'success', title: res.message });
            }
        }).fail(function (xhr) {
            Toast.fire({ icon: 'error', title: xhr.responseJSON?.errors?.department_name?.[0] });
        });
    });

    /* ================= EDIT ================= */
    window.editDepartment = function (id) {
        $.get("<?php echo e(url('admin/departments/get')); ?>/" + id, function (data) {
            $('#editid').val(data.id);
            $('#edit_department_name').val(data.department_name);
            $('#editModal').modal('show');
        });
    };

    /* ================= UPDATE ================= */
    $('#EditDepartment').click(function () {

        $.post("<?php echo e(route('admin.departments.update')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            id: $('#editid').val(),
            department_name: $('#edit_department_name').val()
        }, function (res) {
            if (res.success) {
                $('#editModal').modal('hide');
                table.ajax.reload(null, false);

                Toast.fire({ icon: 'success', title: res.message });
            }
        }).fail(function (xhr) {
            Toast.fire({ icon: 'error', title: xhr.responseJSON?.errors?.department_name?.[0] });
        });
    });

    /* ================= DELETE ================= */
    window.deleteDepartment = function (id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "<?php echo e(url('admin/departments/delete')); ?>/" + id,
                method: "DELETE",
                data: { _token: "<?php echo e(csrf_token()); ?>" },
                success: function (res) {
                    if (res.success) {
                        table.ajax.reload(null, false);
                        Toast.fire({ icon: 'success', title: res.message });
                    }
                }
            });
        }
    };

    /* ================= STATUS ================= */
    $(document).on('change', '.changeStatus', function () {

        $.post("<?php echo e(route('admin.departments.status')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            departmentId: $(this).data('id'),
            status: $(this).is(':checked') ? 'active' : 'inactive'
        }, function (res) {
            if (res.success) {
                table.ajax.reload(null, false);
                Toast.fire({ icon: 'success', title: 'Status updated!' });
            }
        });
    });
    /* ================= SELECT ALL ================= */
    $('#selectAll').on('change', function () {
        $('.rowCheckbox').prop('checked', $(this).is(':checked'));
    });

    $(document).on('change', '.rowCheckbox', function () {
        $('#selectAll').prop(
            'checked',
            $('.rowCheckbox:checked').length === $('.rowCheckbox').length
        );
    });

    /* ================= BULK DELETE ================= */
    function getSelectedIds() {
        let ids = [];
        $('.rowCheckbox:checked').each(function () {
            ids.push($(this).val());
        });
        return ids;
    }

    /* ================= BULK DELETE ================= */
    $('#bulkDelete').click(function () {
        let ids = getSelectedIds();
        if (ids.length === 0) {
            alert('Please select at least one department');
            return;
        }

        if (!confirm('Are you sure you want to delete selected departments?')) return;

        $.post("<?php echo e(route('admin.departments.bulkDelete')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            ids: ids
        }, function (res) {
            if (res.success) {
                table.ajax.reload(null, false);
                $('#selectAll').prop('checked', false);
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    });

    /* ================= BULK STATUS ================= */
    function bulkStatus(status) {
        let ids = getSelectedIds();

        if (ids.length === 0) {
            alert('Please select at least one department');
            return;
        }

        $.post("<?php echo e(route('admin.departments.bulkStatus')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            ids: ids,
            status: status
        }, function (res) {
            if (res.success) {
                table.ajax.reload(null, false);
                $('#selectAll').prop('checked', false);
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    }

    /* ================= BULK ACTIVE/INACTIVE ================= */
    $('#bulkActive').click(() => bulkStatus('active'));
    $('#bulkInactive').click(() => bulkStatus('inactive'));

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/department/index.blade.php ENDPATH**/ ?>