@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
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

    <div class="row mb-3">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Default Checklist (Added by Admin)
                </div>
                <div class="card-body mt-2 mb-2">

                    @if(isset($departments) && count($departments) > 0)
                        <div class="row">
                            @foreach($departments as $dept)
                                <div class="col-md-3 mb-2">
                                    <div class="form-check">

                                        <input class="form-check-input checklist-item"
                                            type="checkbox"
                                            value="{{ $dept->name }}"
                                            id="dept_{{ $dept->id }}"

                                            {{ in_array($dept->name, $departmentcompany) ? 'checked disabled' : '' }}
                                        >

                                        <label class="form-check-label" for="dept_{{ $dept->id }}">
                                            {{ $dept->name }}
                                        </label>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- ✅ Submit Button -->
                        <div class="mt-3 text-end">
                            <button class="btn btn-success" id="saveChecklist">
                                Save Checklist
                            </button>
                        </div>
                    @else
                        <p class="text-muted">No checklist available</p>
                    @endif
                </div>
            </div>
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
                            <th>Action</th>
                        </tr>
                    </thead>
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

{{-- ================= EDIT MODAL ================= --}}
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
@endsection

@section('script')
<script>
    $(document).ready(function () {
        const masterDepartmentNames = @json(
            collect($departments ?? [])->pluck('name')->map(fn ($name) => strtolower(trim($name)))->values()
        );

        const table = $('#departmentTable').DataTable({
            processing: true,
            ajax: "{{ route('company.departments.getall') }}",
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
                    render: function (id, type, row) {
                        const isMasterDepartment = masterDepartmentNames.includes(
                            String(row.department_name || '').trim().toLowerCase()
                        );

                        const editButton = isMasterDepartment
                            ? `<button class="btn btn-sm btn-secondary" disabled title="Master department cannot be edited">Edit</button>`
                            : `<button class="btn btn-sm btn-warning" onclick="editDepartment(${id})">Edit</button>`;

                        return `
                            ${editButton}
                            <button class="btn btn-sm btn-danger" onclick="deleteDepartment(${id})">Delete</button>
                        `;
                    }
                }
            ]
        });


        /* ================= ADD ================= */
        $('#AddDepartment').click(function () {

            $.post("{{ route('company.departments.store') }}", {
                _token: "{{ csrf_token() }}",
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
            $.get("{{ url('company/departments/get') }}/" + id, function (data) {
                $('#editid').val(data.id);
                $('#edit_department_name').val(data.department_name);
                $('#editModal').modal('show');
            });
        };

        /* ================= UPDATE ================= */
        $('#EditDepartment').click(function () {

            $.post("{{ route('company.departments.update') }}", {
                _token: "{{ csrf_token() }}",
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
                    url: "{{ url('company/departments/delete') }}/" + id,
                    method: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
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

            $.post("{{ route('company.departments.status') }}", {
                _token: "{{ csrf_token() }}",
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

            $.post("{{ route('company.departments.bulkDelete') }}", {
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

            $.post("{{ route('company.departments.bulkStatus') }}", {
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


        $('#saveChecklist').click(function () {

            let selected = [];

            $('.checklist-item:checked').each(function () {
                selected.push($(this).val());
            });

            if (selected.length === 0) {
                alert('Please select at least one checklist');
                return;
            }

            $.post("{{ route('company.departments.checklist.save') }}", {
                _token: "{{ csrf_token() }}",
                departments: selected
            }, function (res) {

                if (res.success) {

                    table.ajax.reload(null, false);
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                }

            }).fail(function () {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                });
            });

        });

    });
</script>

@endsection
