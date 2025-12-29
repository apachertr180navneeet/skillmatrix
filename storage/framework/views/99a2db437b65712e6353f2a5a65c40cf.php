

<?php $__env->startSection('style'); ?>
<style>
    .error-text {
        font-size: 12px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-4">
            <h5><span class="text-primary fw-light">User</span> Management</h5>
        </div>
        <div class="col-md-8 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add User
            </button>
            <button class="btn btn-danger" id="bulkDelete">Delete Selected</button>
            <button class="btn btn-success" id="bulkActive">Set Active</button>
            <button class="btn btn-secondary" id="bulkInactive">Set Inactive</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="selectAll"></th>
                            <th>User Name</th>
                            <th>Department</th>
                            <th>HOD Name</th>
                            <th>HOD Email</th>
                            <th>Phone</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                
                <div class="col-12">
                    <div class="alert alert-danger d-none" id="planError"></div>
                </div>

                <div class="col-md-6">
                    <label>User Name</label>
                    <input type="text" id="name" class="form-control">
                    <small class="text-danger error-text name_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Department</label>
                    <select id="department_id" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <small class="text-danger error-text department_id_error"></small>
                </div>

                <div class="col-md-6">
                    <label>HOD Name</label>
                    <input type="text" id="hod_name" class="form-control">
                    <small class="text-danger error-text hod_name_error"></small>
                </div>

                <div class="col-md-6">
                    <label>HOD Email</label>
                    <input type="email" id="hod_email" class="form-control">
                    <small class="text-danger error-text hod_email_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Phone Number</label>
                    <input type="text" id="phone" class="form-control">
                    <small class="text-danger error-text phone_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Password</label>
                    <input type="password" id="password" class="form-control">
                    <small class="text-danger error-text password_error"></small>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddUser">Save</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                <input type="hidden" id="editid">

                <div class="col-md-6">
                    <label>User Name</label>
                    <input type="text" id="edit_name" class="form-control">
                    <small class="text-danger error-text edit_name_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Department</label>
                    <select id="edit_department_id" class="form-control"></select>
                    <small class="text-danger error-text edit_department_id_error"></small>
                </div>

                <div class="col-md-6">
                    <label>HOD Name</label>
                    <input type="text" id="edit_hod_name" class="form-control">
                    <small class="text-danger error-text edit_hod_name_error"></small>
                </div>

                <div class="col-md-6">
                    <label>HOD Email</label>
                    <input type="email" id="edit_hod_email" class="form-control">
                    <small class="text-danger error-text edit_hod_email_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Phone Number</label>
                    <input type="text" id="edit_phone" class="form-control">
                    <small class="text-danger error-text edit_phone_error"></small>
                </div>

                <div class="col-md-6">
                    <label>Password (optional)</label>
                    <input type="password" id="edit_password" class="form-control">
                    <small class="text-danger error-text edit_password_error"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="EditUser">Update</button>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function () {

    /* ================= DATATABLE ================= */
    const table = $('#userTable').DataTable({
        ajax: "<?php echo e(route('admin.user.getall')); ?>",
        columns: [
            { data:'id', render:id=>`<input type="checkbox" class="rowCheckbox" value="${id}">`, orderable:false },
            { data:'full_name' },
            { data:'department.department_name' },
            { data:'hod_name' },
            { data:'hod_email' },
            { data:'phone' },
            {
                data:'status',
                render:(d,t,row)=>`
                    <div class="form-check form-switch">
                        <input class="form-check-input changeStatus"
                               type="checkbox"
                               data-id="${row.id}"
                               ${d === 'active' ? 'checked' : ''}>
                    </div>`
            },
            {
                data:'id',
                render:id=>`
                    <button class="btn btn-sm btn-warning" onclick="editUser(${id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${id})">Delete</button>`
            }
        ]
    });

    /* ================= HELPERS ================= */
    function clearErrors(){
        $('.error-text').text('');
        $('.form-control').removeClass('is-invalid');
        $('#planError').addClass('d-none').text('');
    }

    function loadDepartments(select){
        $.get("<?php echo e(route('admin.departments.getall')); ?>",res=>{
            select.empty().append('<option value="">Select</option>');
            res.data.forEach(d=>{
                select.append(`<option value="${d.id}">${d.department_name}</option>`);
            });
        });
    }

    loadDepartments($('#department_id'));
    loadDepartments($('#edit_department_id'));

    /* ================= ADD USER ================= */
    $('#AddUser').click(function(){
        clearErrors();

        $.ajax({
            url:"<?php echo e(route('admin.user.store')); ?>",
            type:"POST",
            data:{
                _token:"<?php echo e(csrf_token()); ?>",
                name:$('#name').val(),
                department_id:$('#department_id').val(),
                hod_name:$('#hod_name').val(),
                hod_email:$('#hod_email').val(),
                phone:$('#phone').val(),
                password:$('#password').val(),
            },
            success:res=>{
                $('#addModal').modal('hide');
                table.ajax.reload(null,false);
                Toast.fire({icon:'success',title:res.message});
            },
            error:xhr=>{
                if(xhr.status === 422){

                    // PLAN LIMIT ERROR
                    if(xhr.responseJSON.errors.plan){
                        $('#planError')
                            .removeClass('d-none')
                            .text(xhr.responseJSON.errors.plan[0]);
                        return;
                    }

                    // FIELD ERRORS
                    $.each(xhr.responseJSON.errors,(k,v)=>{
                        $('.'+k+'_error').text(v[0]);
                        $('#'+k).addClass('is-invalid');
                    });
                }
            }
        });
    });

    /* ================= EDIT USER ================= */
    window.editUser=function(id){
        $.get("<?php echo e(url('admin/users/get')); ?>/"+id,data=>{
            $('#editid').val(data.id);
            $('#edit_name').val(data.full_name);
            $('#edit_department_id').val(data.department_id);
            $('#edit_hod_name').val(data.hod_name);
            $('#edit_hod_email').val(data.hod_email);
            $('#edit_phone').val(data.phone);
            $('#editModal').modal('show');
        });
    };

    $('#EditUser').click(function(){
        clearErrors();

        $.ajax({
            url:"<?php echo e(route('admin.user.update')); ?>",
            type:"POST",
            data:{
                _token:"<?php echo e(csrf_token()); ?>",
                id:$('#editid').val(),
                name:$('#edit_name').val(),
                department_id:$('#edit_department_id').val(),
                hod_name:$('#edit_hod_name').val(),
                hod_email:$('#edit_hod_email').val(),
                phone:$('#edit_phone').val(),
                password:$('#edit_password').val(),
            },
            success:res=>{
                $('#editModal').modal('hide');
                table.ajax.reload(null,false);
                Toast.fire({icon:'success',title:res.message});
            },
            error:xhr=>{
                if(xhr.status===422){
                    $.each(xhr.responseJSON.errors,(k,v)=>{
                        $('.edit_'+k+'_error').text(v[0]);
                        $('#edit_'+k).addClass('is-invalid');
                    });
                }
            }
        });
    });

    /* ================= DELETE ================= */
    window.deleteUser=function(id){
        if(confirm('Are you sure?')){
            $.ajax({
                url:"<?php echo e(url('admin/users/delete')); ?>/"+id,
                method:"DELETE",
                data:{ _token:"<?php echo e(csrf_token()); ?>" },
                success:res=>{
                    table.ajax.reload(null,false);
                    Toast.fire({icon:'success',title:res.message});
                }
            });
        }
    };

    /* ================= STATUS ================= */
    $(document).on('change','.changeStatus',function(){
        $.post("<?php echo e(route('admin.user.status')); ?>",{
            _token:"<?php echo e(csrf_token()); ?>",
            userId:$(this).data('id'),
            status:$(this).is(':checked')?'active':'inactive'
        },()=>{
            table.ajax.reload(null,false);
        });
    });

    /* ================= SELECT ALL ================= */
    $('#selectAll').on('change',function(){
        $('.rowCheckbox').prop('checked',$(this).is(':checked'));
    });

    $(document).on('change','.rowCheckbox',function(){
        $('#selectAll').prop(
            'checked',
            $('.rowCheckbox:checked').length === $('.rowCheckbox').length
        );
    });

    function getSelectedIds(){
        let ids=[];
        $('.rowCheckbox:checked').each(function(){
            ids.push($(this).val());
        });
        return ids;
    }

    /* ================= BULK DELETE ================= */
    $('#bulkDelete').click(function(){
        let ids=getSelectedIds();
        if(ids.length===0) return alert('Please select at least one user');
        if(!confirm('Are you sure?')) return;

        $.post("<?php echo e(route('admin.user.bulkDelete')); ?>",{
            _token:"<?php echo e(csrf_token()); ?>",
            ids:ids
        },res=>{
            table.ajax.reload(null,false);
            $('#selectAll').prop('checked',false);
            Toast.fire({icon:'success',title:res.message});
        });
    });

    /* ================= BULK STATUS ================= */
    function bulkStatus(status){
        let ids=getSelectedIds();
        if(ids.length===0) return alert('Please select at least one user');

        $.post("<?php echo e(route('admin.user.bulkStatus')); ?>",{
            _token:"<?php echo e(csrf_token()); ?>",
            ids:ids,
            status:status
        },res=>{
            table.ajax.reload(null,false);
            $('#selectAll').prop('checked',false);
            Toast.fire({icon:'success',title:res.message});
        });
    }

    $('#bulkActive').click(()=>bulkStatus('active'));
    $('#bulkInactive').click(()=>bulkStatus('inactive'));

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/user/index.blade.php ENDPATH**/ ?>