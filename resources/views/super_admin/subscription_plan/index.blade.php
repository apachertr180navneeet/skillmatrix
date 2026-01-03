@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-6">
            <h5><span class="text-primary fw-light">Subscription</span> Plans</h5>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Plan
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="planTable">
                    <thead>
                        <tr>
                            <th>Plan Name</th>
                            <th>Amount</th>
                            <th>Duration (Days)</th>
                            <th>Description</th>
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
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Subscription Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label>Plan Name</label>
                        <input type="text" id="plan_name" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Amount</label>
                        <input type="number" id="amount" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Duration (Days)</label>
                        <input type="number" id="duration" class="form-control">
                    </div>

                    <input type="hidden" id="user" value="0" class="form-control">
                    
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea id="description" class="form-control"></textarea>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddPlan">Save</button>
            </div>

        </div>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Subscription Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editid">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label>Plan Name</label>
                        <input type="text" id="edit_plan_name" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Amount</label>
                        <input type="number" id="edit_amount" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Duration (Days)</label>
                        <input type="number" id="edit_duration" class="form-control">
                    </div>

                    <input type="hidden" id="edit_user" value="0" class="form-control">

                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea id="edit_description" class="form-control"></textarea>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="EditPlan">Update</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {

    const table = $('#planTable').DataTable({
        processing: true,
        ajax: "{{ route('super.admin.subscriptionPlan.getall') }}",
        columns: [
            { data: 'plan_name' },
            { data: 'amount' },
            { data: 'duration' },
            { data: 'description' },
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
                        <button class="btn btn-sm btn-warning" onclick="editPlan(${id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deletePlan(${id})">Delete</button>
                    `;
                }
            }
        ]
    });

    $('#AddPlan').click(function () {
        $.post("{{ route('super.admin.subscriptionPlan.store') }}", {
            _token: "{{ csrf_token() }}",
            plan_name: $('#plan_name').val(),
            amount: $('#amount').val(),
            duration: $('#duration').val(),
            user: $('#user').val(),
            description: $('#description').val()
        }, function (res) {
            if (res.success) {
                $('#addModal').modal('hide');
                $('#addModal').find('input,textarea').val('');
                table.ajax.reload();
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    });

    window.editPlan = function (id) {
        $.get("{{ url('super-admin/subscriptionPlan/get') }}/" + id, function (data) {
            $('#editid').val(data.id);
            $('#edit_plan_name').val(data.plan_name);
            $('#edit_amount').val(data.amount);
            $('#edit_duration').val(data.duration);
            $('#edit_user').val(data.user);
            $('#edit_description').val(data.description);
            $('#editModal').modal('show');
        });
    };

    $('#EditPlan').click(function () {
        $.post("{{ route('super.admin.subscriptionPlan.update') }}", {
            _token: "{{ csrf_token() }}",
            id: $('#editid').val(),
            plan_name: $('#edit_plan_name').val(),
            amount: $('#edit_amount').val(),
            duration: $('#edit_duration').val(),
            user: $('#edit_user').val(),
            description: $('#edit_description').val()
        }, function (res) {
            if (res.success) {
                $('#editModal').modal('hide');
                table.ajax.reload();
                Toast.fire({ icon: 'success', title: res.message });
            }
        });
    });

    window.deletePlan = function (id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "{{ url('super-admin/subscriptionPlan/delete') }}/" + id,
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

    $(document).on('change', '.changeStatus', function () {
        $.post("{{ route('super.admin.subscriptionPlan.status') }}", {
            _token: "{{ csrf_token() }}",
            planId: $(this).data('id'),
            status: $(this).is(':checked') ? 'active' : 'inactive'
        });
    });

});
</script>
@endsection
