

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-6">
            <h5><span class="text-primary fw-light">Company</span></h5>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Company
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="companyTable">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" id="copmany_name" class="form-control" placeholder="Enter company name">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Admin Name</label>
                        <input type="text" id="admin_name" class="form-control" placeholder="Enter admin name">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" id="phone" class="form-control" placeholder="Enter phone">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" id="address" class="form-control" placeholder="Enter address">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" id="city" class="form-control" placeholder="Enter city">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">State</label>
                        <input type="text" id="state" class="form-control" placeholder="Enter state">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" id="country" class="form-control" placeholder="Enter country">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" id="logo" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddItem">Save</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editid">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Company Name</label>
                        <input type="text" id="editcopmany_name" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Admin Name</label>
                        <input type="text" id="editadmin_name" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" id="editemail" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" id="editphone" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Address</label>
                        <input type="text" id="editaddress" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" id="editcity" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>State</label>
                        <input type="text" id="editstate" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Country</label>
                        <input type="text" id="editcountry" class="form-control">
                        <small class="error-text text-danger"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Logo</label>
                        <input type="file" id="editlogo" class="form-control">
                        <img id="editLogoPreview" class="mt-2" style="width: 80px; height: auto; display: none;">
                        <small class="error-text text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="EditCompany">Update</button>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).ready(function () {

    const table = $('#companyTable').DataTable({
        processing: true,
        ajax: "<?php echo e(route('super.admin.company.getall')); ?>",
        columns: [
            { data: 'copmany_name' },
            { data: 'admin_name' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'city' },
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
                        <button class="btn btn-sm btn-warning" onclick="editCompany(${id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCompany(${id})">Delete</button>
                    `;
                }
            }
        ]
    });


    /* CLEAR ERRORS */

    function clearErrors() {

        $('.error-text').text('');
        $('.form-control').removeClass('is-invalid');

    }

    /* ADD COMPANY */

    $('#AddItem').click(function () {

        clearErrors();

        let formData = new FormData();

        formData.append('copmany_name', $('#copmany_name').val());
        formData.append('admin_name', $('#admin_name').val());
        formData.append('email', $('#email').val());
        formData.append('phone', $('#phone').val());
        formData.append('address', $('#address').val());
        formData.append('city', $('#city').val());
        formData.append('state', $('#state').val());
        formData.append('country', $('#country').val());

        if ($('#logo')[0].files[0]) {
            formData.append('logo', $('#logo')[0].files[0]);
        }

        formData.append('_token', "<?php echo e(csrf_token()); ?>");

        $.ajax({

            url: "<?php echo e(route('super.admin.company.store')); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {

                $('#addModal').modal('hide');
                $('#addModal').find('input').val('');
                table.ajax.reload();

                Toast.fire({
                    icon: 'success',
                    title: res.message
                });

            },

            error: function (xhr) {

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {

                        let input = $('#' + key);

                        input.addClass('is-invalid');

                        input.closest('.mb-3')
                            .find('.error-text')
                            .text(value[0]);

                    });

                }

            }

        });

    });

    // Expose functions
    window.editCompany = function (id) {
        $.get("<?php echo e(url('master/company/get')); ?>/" + id, function (data) {

            $('#editid').val(data.id);
            $('#editcopmany_name').val(data.copmany_name);
            $('#editadmin_name').val(data.admin_name);
            $('#editemail').val(data.email);
            $('#editphone').val(data.phone);
            $('#editaddress').val(data.address);
            $('#editcity').val(data.city);
            $('#editstate').val(data.state);
            $('#editcountry').val(data.country);

            // ✅ Logo preview (if stored as full URL in DB)
            if (data.logo) {
                $('#editLogoPreview').attr('src', data.logo).show();
            } else {
                $('#editLogoPreview').hide();
            }

            $('#editModal').modal('show');
        });
    };

    // Update company

    $('#EditCompany').click(function () {

        clearErrors();

        let formData = new FormData();

        formData.append('_token', "<?php echo e(csrf_token()); ?>");
        formData.append('id', $('#editid').val());
        formData.append('copmany_name', $('#editcopmany_name').val());
        formData.append('admin_name', $('#editadmin_name').val());
        formData.append('email', $('#editemail').val());
        formData.append('phone', $('#editphone').val());
        formData.append('address', $('#editaddress').val());
        formData.append('city', $('#editcity').val());
        formData.append('state', $('#editstate').val());
        formData.append('country', $('#editcountry').val());

        if ($('#editlogo')[0].files[0]) {
            formData.append('logo', $('#editlogo')[0].files[0]);
        }

        $.ajax({

            url: "<?php echo e(route('super.admin.company.update')); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {

                $('#editModal').modal('hide');
                table.ajax.reload();

                Toast.fire({
                    icon: 'success',
                    title: res.message
                });

            },

            error: function (xhr) {

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {

                        let input = $('#edit' + key);

                        input.addClass('is-invalid');

                        input.closest('.mb-3')
                            .find('.error-text')
                            .text(value[0]);

                    });

                }

            }

        });

    });


    // Delete
    window.deleteCompany = function (id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "<?php echo e(url('master/company/delete')); ?>/" + id,
                method: "DELETE",
                data: { _token: "<?php echo e(csrf_token()); ?>" },
                success: function (res) {
                    if (res.success) {
                        table.ajax.reload();
                        Toast.fire({ icon: 'success', title: res.message });
                    }
                }
            });
        }
    };

    $(document).on('change', '.changeStatus', function () {

        let id = $(this).data('id');
        let status = $(this).is(':checked') ? 'active' : 'inactive';

        $.ajax({
            url: "<?php echo e(route('super.admin.company.status')); ?>",
            type: "POST",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                companyId: id,
                status: status
            },
            success: function (res) {
                if (res.success) {
                    Toast.fire({ icon: 'success', title: 'Status updated!' });
                }
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/company/index.blade.php ENDPATH**/ ?>