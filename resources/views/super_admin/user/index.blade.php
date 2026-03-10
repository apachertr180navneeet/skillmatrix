@extends('super_admin.layouts.app')

@section('style')
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-6">
            <h5><span class="text-primary fw-light">Users</span></h5>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add User
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="userTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>HOD Name</th>
                            <th>HOD Email</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{-- ===================== ADD USER MODAL ===================== --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control">
                        <small id="name_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control">
                        <small id="email_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" id="phone" class="form-control">
                        <small id="phone_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" id="city" class="form-control">
                        <small id="city_error" class="text-danger"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>HOD Name</label>
                        <input type="text" id="hod_name" class="form-control">
                        <small id="hod_name_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>HOD Email</label>
                        <input type="email" id="hod_email" class="form-control">
                        <small id="hod_email_error" class="text-danger"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Company</label>
                        <select id="company_id" class="form-control">
                            <option value="0">Select Company</option>
                            @foreach($companies as $c)
                                <option value="{{ $c->id }}">{{ $c->copmany_name }}</option>
                            @endforeach
                        </select>
                        <small id="company_id_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control">
                        <small id="password_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" id="password_confirmation" class="form-control">
                        <small id="password_confirmation_error" class="text-danger"></small>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="AddUser">Save</button>
            </div>

        </div>
    </div>
</div>


{{-- ===================== EDIT USER MODAL ===================== --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editid">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" id="editname" class="form-control">
                        <small id="editname_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" id="editemail" class="form-control">
                        <small id="editemail_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" id="editphone" class="form-control">
                        <small id="editphone_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>City</label>
                        <input type="text" id="editcity" class="form-control">
                        <small id="editcity_error" class="text-danger"></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>HOD Name</label>
                        <input type="text" id="edithod_name" class="form-control">
                        <small id="edithod_name_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>HOD Email</label>
                        <input type="email" id="edithod_email" class="form-control">
                        <small id="edithod_email_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Company</label>
                        <select id="editcompany" class="form-control">
                            @foreach($companies as $c)
                                <option value="{{ $c->id }}">{{ $c->copmany_name }}</option>
                            @endforeach
                        </select>
                        <small id="editcompany_error" class="text-danger"></small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>New Password (Optional)</label>
                        <input type="password" id="editpassword" class="form-control">
                        <small id="editpassword_error" class="text-danger"></small>

                        <input type="password" id="editpassword_confirmation" class="form-control mt-2" placeholder="Confirm Password">
                        <small id="editpassword_confirmation_error" class="text-danger"></small>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="UpdateUser">Update</button>
            </div>

        </div>
    </div>
</div>

@endsection



@section('script')
<script>
$(function(){

    const table = $('#userTable').DataTable({
        processing: true,
        ajax: "{{ route('super.admin.user.getall') }}",
        columns: [
            { data: 'full_name' },
            { data: 'hod_name', defaultContent:'-' },
            { data: 'hod_email', defaultContent:'-' },
            { data: 'email' },
            { data: 'phone' },
            { data: 'company.name', defaultContent:'-' },
            {
                data:'status',
                render:function(data,row,type){
                    let checked = data === "active" ? "checked" : "";
                    return `<div class="form-check form-switch">
                        <input type="checkbox" data-id="${type.id}" class="form-check-input toggleStatus" ${checked}>
                    </div>`;
                }
            },
            {
                data:'id',
                render:(id)=>`
                    <button class="btn btn-sm btn-warning" onclick="editUser(${id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${id})">Delete</button>`
            }
        ]
    });


    //================ ADD USER ==================
    $("#AddUser").click(function(){

        $("small.text-danger").text(""); // CLEAR PREVIOUS ERRORS

        let form = new FormData();
        form.append("_token","{{ csrf_token() }}");
        form.append("name",$("#name").val());
        form.append("email",$("#email").val());
        form.append("phone",$("#phone").val());
        form.append("city",$("#city").val());
        form.append("hod_name",$("#hod_name").val());
        form.append("hod_email",$("#hod_email").val());
        form.append("company_id",$("#company_id").val());
        form.append("password",$("#password").val());
        form.append("password_confirmation",$("#password_confirmation").val());

        $.ajax({
            url:"{{ route('super.admin.user.store') }}",
            method:"POST",
            data:form,
            contentType:false,
            processData:false,
            success:function(res){
                $("#addModal").modal("hide");
                $("#addModal input").val("");
                table.ajax.reload();
                Toast.fire({icon:"success",title:res.message});
            },
            error:function(err){
                if(err.status==422){
                    $.each(err.responseJSON.errors,function(key,val){
                        $("#"+key+"_error").text(val[0]);
                    });
                }
            }
        });

    });



    //================ GET USER ==================
    window.editUser=function(id){
        $("small.text-danger").text(""); // clear old errors
        $.get("{{ url('super-admin/user/get') }}/"+id,function(d){
            $("#editid").val(d.id);
            $("#editname").val(d.full_name);
            $("#editemail").val(d.email);
            $("#editphone").val(d.phone);
            $("#editcity").val(d.city);
            $("#edithod_name").val(d.hod_name);
            $("#edithod_email").val(d.hod_email);
            $("#editcompany").val(d.company_id);
            $("#editModal").modal("show");
        });
    }


    //================ UPDATE USER ==================
    $("#UpdateUser").click(function(){

        $("small.text-danger").text(""); // CLEAR ERRORS

        let form=new FormData();
        form.append("_token","{{ csrf_token() }}");
        form.append("id",$("#editid").val());
        form.append("name",$("#editname").val());
        form.append("email",$("#editemail").val());
        form.append("phone",$("#editphone").val());
        form.append("city",$("#editcity").val());
        form.append("hod_name",$("#edithod_name").val());
        form.append("hod_email",$("#edithod_email").val());
        form.append("company_id",$("#editcompany").val());
        form.append("password",$("#editpassword").val());
        form.append("password_confirmation",$("#editpassword_confirmation").val());

        $.ajax({
            url:"{{ route('super.admin.user.update') }}",
            method:"POST",
            data:form,
            contentType:false,
            processData:false,
            success:function(res){
                $("#editModal").modal("hide");
                table.ajax.reload();
                Toast.fire({icon:"success",title:res.message});
            },
            error:function(err){
                if(err.status==422){
                    $.each(err.responseJSON.errors,function(key,val){
                        $("#edit"+key+"_error").text(val[0]);
                    });
                }
            }
        });

    });



    //================ DELETE USER ==================
    window.deleteUser=function(id){
        if(confirm("Are you sure?")){
            $.ajax({
                url:"{{ url('super-admin/user/delete') }}/"+id,
                method:"DELETE",
                data:{_token:"{{ csrf_token() }}"},
                success:function(r){
                    table.ajax.reload();
                    Toast.fire({icon:"success",title:r.message});
                }
            });
        }
    }


    //================ STATUS ==================
    $(document).on("change",".toggleStatus",function(){
        let id=$(this).data("id");
        let status=$(this).is(":checked")?"active":"inactive";

        $.post({
            url:"{{ route('super.admin.user.status') }}",
            data:{_token:"{{ csrf_token() }}",userId:id,status:status},
            success:()=>Toast.fire({icon:"success",title:"Status Updated"})
        });
    });

});
</script>
@endsection
