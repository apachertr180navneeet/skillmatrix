

<?php $__env->startSection('style'); ?>
<style>
    .top-actions button { margin-left: 6px; }

    .sop-card {
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        text-align: center;
        height: 100%;
    }

    .sop-box {
        height: 110px;
        background: #1e78d6;
        border-radius: 14px;
        margin-bottom: 12px;
    }

    .sop-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .sop-actions {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 8px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP ACTION BUTTONS ================= -->
    <div class="d-flex justify-content-end mb-4 top-actions">
        <button class="btn btn-primary btn-sm">Sort</button>
        <button class="btn btn-primary btn-sm">View</button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
            + Create
        </button>
    </div>

    <!-- ================= SUGGESTED SOP ================= -->
    <h5 class="mb-3">Suggestions SOP</h5>
    <div class="row g-3 mb-5">
        <?php for($i = 1; $i <= 4; $i++): ?>
            <div class="col-md-3">
                <div class="sop-card">
                    <div class="sop-box"></div>
                    <div class="sop-title">SOP <?php echo e($i); ?></div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <!-- ================= CREATED SOP ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created SOP</h5>
        <select id="departmentFilter" class="form-select w-auto">
            <option value="">Department</option>
        </select>
    </div>

    <div class="row g-3" id="sopContainer"></div>
</div>


<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Create SOP</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Department</label>
                    <select id="department_id" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" id="title" class="form-control">
                </div>

                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="description" class="form-control" rows="4"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="saveSop">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit SOP</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                <input type="hidden" id="edit_id">

                <div class="col-md-6">
                    <label>Department</label>
                    <select id="edit_department_id" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" id="edit_title" class="form-control">
                </div>

                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="edit_description" class="form-control" rows="4"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="updateSop">Update</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function () {

    /* ================= LOAD DEPARTMENTS ================= */
    function loadDepartments() {
        $.get("<?php echo e(route('admin.departments.getall')); ?>", function (res) {

            let options = `<option value="">Select Department</option>`;
            res.data.forEach(dep => {
                options += `<option value="${dep.id}">${dep.department_name}</option>`;
            });

            $('#departmentFilter').html(`<option value="">Department</option>` + options);
            $('#department_id').html(options);
            $('#edit_department_id').html(options);
        });
    }
    loadDepartments();

    /* ================= LOAD SOP CARDS ================= */
    function loadSops(department_id = '') {
        $.get("<?php echo e(route('admin.sop.getall')); ?>", function (res) {

            let html = '';

            if (res.data.length === 0) {
                html = `<div class="col-12 text-center text-muted">No SOP Found</div>`;
            }

            res.data.forEach(sop => {
                if (department_id && sop.department_id != department_id) return;

                html += `
                <div class="col-md-3">
                    <div class="sop-card">
                        <div class="sop-box"></div>
                        <div class="sop-title">${sop.title}</div>

                        <div class="sop-actions">
                            <button class="btn btn-danger btn-sm"
                                onclick="addQA(${sop.id})">Add Q&A</button>

                            <button class="btn btn-warning btn-sm"
                                onclick="editSop(${sop.id})">Edit</button>
                        </div>
                    </div>
                </div>`;
            });

            $('#sopContainer').html(html);
        });
    }

    loadSops();

    $('#departmentFilter').change(function () {
        loadSops($(this).val());
    });

    /* ================= CREATE SOP ================= */
    $('#saveSop').click(function () {
        $.post("<?php echo e(route('admin.sop.store')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            department_id: $('#department_id').val(),
            title: $('#title').val(),
            description: $('#description').val()
        }, function (res) {
            $('#createModal').modal('hide');
            loadSops();
            Toast.fire({ icon: 'success', title: res.message });
        });
    });

    /* ================= EDIT SOP ================= */
    window.editSop = function (id) {
        $.get("<?php echo e(url('admin/sop/get')); ?>/" + id, function (res) {
            $('#edit_id').val(res.id);
            $('#edit_department_id').val(res.department_id);
            $('#edit_title').val(res.title);
            $('#edit_description').val(res.description);
            $('#editModal').modal('show');
        });
    };

    /* ================= UPDATE SOP ================= */
    $('#updateSop').click(function () {
        $.post("<?php echo e(route('admin.sop.update')); ?>", {
            _token: "<?php echo e(csrf_token()); ?>",
            id: $('#edit_id').val(),
            department_id: $('#edit_department_id').val(),
            title: $('#edit_title').val(),
            description: $('#edit_description').val()
        }, function (res) {
            $('#editModal').modal('hide');
            loadSops();
            Toast.fire({ icon: 'success', title: res.message });
        });
    });

    /* ================= ADD Q&A ================= */
    window.addQA = function (id) {
        window.location.href = "<?php echo e(url('admin/sop')); ?>/" + id + "/questions";
    };

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/layouts/elements/left_sidebar.blade.php ENDPATH**/ ?>