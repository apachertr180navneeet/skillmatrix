@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>
                <span class="text-primary fw-light">Department</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add Plan
                </button>
            </div>
        </div>
    </div>

    <!-- SOP Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="departmentTable">
                    <thead>
                        <tr>
                            <th>Department Name</th>
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

{{-- ================= ADD MODAL ================= --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Department Name</label>
                    <input type="text" id="name" class="form-control">
                    <span class="text-danger error-text name_error"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddDepartment">Save</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit_id">

                <div class="mb-3">
                    <label>Department Name</label>
                    <input type="text" id="edit_name" class="form-control">
                    <span class="text-danger error-text edit_name_error"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="UpdateDepartment">Update</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {


    
    const table = $('#departmentTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('super.admin.departments.getall') }}",
        columns: [

            // Department Name
            { data: 'name' },
            // Status
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

            // Action Column
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning editBtn" 
                            data-id="${id}" 
                            data-name="${row.name}">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-danger deleteBtn" onclick="deleteDepartment(${id})" 
                            data-id="${id}">
                            Delete
                        </button>
                    `;
                }
            }
        ]
    });

    $('#AddDepartment').click(function () {

        $('.error-text').text('');

        $.ajax({
            url: "{{ route('super.admin.departments.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                name: $('#name').val(),
            },
            success: function (res) {
                if (res.success) {
                    $('#addModal').modal('hide');
                    $('#addModal').find('input,textarea').val('');
                    table.ajax.reload();

                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                }

            },
            error: function (xhr) {

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    if (errors.name) {
                        $('.name_error').text(errors.name[0]);
                    }

                }

            }
        });

    });

    $(document).on('click', '.editBtn', function () {
        editDepartment($(this).data('id'));
    });

    $('#UpdateDepartment').click(function () {
        $('.error-text').text('');

        $.ajax({
            url: "{{ route('super.admin.departments.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: $('#edit_id').val(),
                name: $('#edit_name').val(),
            },
            success: function (res) {
                if (res.success) {
                    $('#editModal').modal('hide');
                    table.ajax.reload();

                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('.edit_name_error').text(errors.name[0]);
                    }
                }
            }
        });
    });

    $(document).on('change', '.changeStatus', function () {
        $.post("{{ route('super.admin.departments.status') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data('id'),
            status: $(this).is(':checked') ? 'active' : 'inactive'
        });
    });


    window.deleteDepartment = function (id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "{{ url('master/departments/delete') }}/" + id,
                method: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function (res) {
                    if (res.success) {
                        table.ajax.reload();
                        Toast.fire({ icon: 'success', title: res.message });
                    }
                }
            });
        }
    };


    window.editDepartment = function (id) {
        $.get("{{ url('master/departments/get') }}/" + id, function (data) {
            $('#edit_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#editModal').modal('show');
        });
    };

});
</script>
@endsection
