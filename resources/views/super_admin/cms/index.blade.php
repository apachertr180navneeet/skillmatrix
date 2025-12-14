@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-6">
            <h5><span class="text-primary fw-light">CMS</span> Pages</h5>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add CMS Page
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="cmsTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th width="150">Action</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add CMS Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="title" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="description" class="form-control" rows="4"></textarea>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addCms">Save</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit CMS Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit_id">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Title</label>
                        <input type="text" id="edit_title" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea id="edit_description" class="form-control" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="updateCms">Update</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {

    const table = $('#cmsTable').DataTable({
        processing: true,
        ajax: "{{ route('super.admin.cms.getall') }}",
        columns: [
            { data: 'title' },
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
                        <button class="btn btn-sm btn-warning" onclick="editCms(${id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCms(${id})">Delete</button>
                    `;
                }
            }
        ]
    });

    // Add CMS
    $('#addCms').click(function () {
        $.post("{{ route('super.admin.cms.store') }}", {
            _token: "{{ csrf_token() }}",
            title: $('#title').val(),
            description: $('#description').val(),
            status: 'active'
        }, function (res) {
            if (res.success) {
                $('#addModal').modal('hide');
                $('#addModal').find('input, textarea').val('');
                table.ajax.reload();
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    });

    // Edit CMS
    window.editCms = function (id) {
        $.get("{{ url('super-admin/cms/get') }}/" + id, function (data) {
            $('#edit_id').val(data.id);
            $('#edit_title').val(data.title);
            $('#edit_description').val(data.description);
            $('#editModal').modal('show');
        });
    };

    // Update CMS
    $('#updateCms').click(function () {
        $.post("{{ route('super.admin.cms.update') }}", {
            _token: "{{ csrf_token() }}",
            id: $('#edit_id').val(),
            title: $('#edit_title').val(),
            description: $('#edit_description').val(),
            status: 'active'
        }, function (res) {
            if (res.success) {
                $('#editModal').modal('hide');
                table.ajax.reload();
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    });

    // Delete CMS
    window.deleteCms = function (id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "{{ url('super-admin/cms/delete') }}/" + id,
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

    // Status toggle
    $(document).on('change', '.changeStatus', function () {
        $.post("{{ route('super.admin.cms.status') }}", {
            _token: "{{ csrf_token() }}",
            id: $(this).data('id'),
            status: $(this).is(':checked') ? 'active' : 'inactive'
        });
    });

});
</script>
@endsection
