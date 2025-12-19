@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-4">
            <h5><span class="text-primary fw-light">User</span> Management</h5>
        </div>
        <div class="col-md-8 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add User
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
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th width="30">
                                <input type="checkbox" id="selectAll">
                            </th>
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

{{-- ================= ADD MODAL ================= --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                <div class="col-md-6">
                    <label>User Name</label>
                    <input type="text" id="name" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Department</label>
                    <select id="department_id" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>HOD Name</label>
                    <input type="text" id="hod_name" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>HOD Email</label>
                    <input type="email" id="hod_email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Phone Number</label>
                    <input type="text" id="phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Password</label>
                    <input type="password" id="password" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddUser">Save</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
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
                </div>

                <div class="col-md-6">
                    <label>Department</label>
                    <select id="edit_department_id" class="form-control"></select>
                </div>

                <div class="col-md-6">
                    <label>HOD Name</label>
                    <input type="text" id="edit_hod_name" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>HOD Email</label>
                    <input type="email" id="edit_hod_email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Phone Number</label>
                    <input type="text" id="edit_phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Password (optional)</label>
                    <input type="password" id="edit_password" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="EditUser">Update</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {

    const table = $('#userTable').DataTable({
        ajax: "{{ route('admin.user.getall') }}",
        columns: [
            {
                data: 'id',
                render: id => `<input type="checkbox" class="rowCheckbox" value="${id}">`,
                orderable: false
            },
            { data: 'full_name' },
            { data: 'department.department_name' },
            { data: 'hod_name' },
            { data: 'hod_email' },
            { data: 'phone' },
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
                render: id => `
                    <button class="btn btn-sm btn-warning" onclick="editUser(${id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${id})">Delete</button>
                `
            }
        ]
    });

    /* ================= LOAD DEPARTMENTS ================= */
    function loadDepartments(select) {
        $.get("{{ route('admin.departments.getall') }}", function (res) {
            select.empty().append('<option value="">Select</option>');
            res.data.forEach(d => {
                select.append(`<option value="${d.id}">${d.department_name}</option>`);
            });
        });
    }
    loadDepartments($('#department_id'));
    loadDepartments($('#edit_department_id'));

    /* ================= ADD ================= */
    $('#AddUser').click(function () {
        $.post("{{ route('admin.user.store') }}", {
            _token: "{{ csrf_token() }}",
            name: $('#name').val(),
            department_id: $('#department_id').val(),
            hod_name: $('#hod_name').val(),
            hod_email: $('#hod_email').val(),
            phone: $('#phone').val(),
            password: $('#password').val(),
        }, function (res) {
            $('#addModal').modal('hide');
            table.ajax.reload(null,false);
            Toast.fire({ icon:'success', title: res.message });
        });
    });

    /* ================= EDIT ================= */
    window.editUser = function(id){
        $.get("{{ url('admin/users/get') }}/"+id, function(data){
            $('#editid').val(data.id);
            $('#edit_name').val(data.full_name);
            $('#edit_department_id').val(data.department_id);
            $('#edit_hod_name').val(data.hod_name);
            $('#edit_hod_email').val(data.hod_email);
            $('#edit_phone').val(data.phone);
            $('#editModal').modal('show');
        });
    };

    /* ================= UPDATE ================= */
    $('#EditUser').click(function(){
        $.post("{{ route('admin.user.update') }}", {
            _token: "{{ csrf_token() }}",
            id: $('#editid').val(),
            name: $('#edit_name').val(),
            department_id: $('#edit_department_id').val(),
            hod_name: $('#edit_hod_name').val(),
            hod_email: $('#edit_hod_email').val(),
            phone: $('#edit_phone').val(),
            password: $('#edit_password').val(),
        }, function(res){
            $('#editModal').modal('hide');
            table.ajax.reload(null,false);
            Toast.fire({ icon:'success', title: res.message });
        });
    });

    /* ================= DELETE ================= */
    window.deleteUser = function(id){
        if(confirm('Are you sure?')){
            $.ajax({
                url: "{{ url('admin/users/delete') }}/"+id,
                method: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: res => {
                    table.ajax.reload(null,false);
                    Toast.fire({ icon:'success', title: res.message });
                }
            });
        }
    };

    /* ================= STATUS ================= */
    $(document).on('change', '.changeStatus', function () {

        $.post("{{ route('admin.user.status') }}", {
            _token: "{{ csrf_token() }}",
            userId: $(this).data('id'),
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
            alert('Please select at least one user');
            return;
        }

        if (!confirm('Are you sure you want to delete selected users?')) return;

        $.post("{{ route('admin.user.bulkDelete') }}", {
            _token: "{{ csrf_token() }}",
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

        $.post("{{ route('admin.user.bulkStatus') }}", {
            _token: "{{ csrf_token() }}",
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
@endsection
