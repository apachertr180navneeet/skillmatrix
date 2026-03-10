@extends('admin.layouts.app')

@section('style')
<style>

.table th{
    font-size:13px;
    font-weight:600;
    background:#f8f9fa;
}

.table td{
    font-size:13px;
    vertical-align:middle;
}

/* View Button */
.btn-view{
    background:#0ea5e9;
    color:#fff;
    border-radius:8px;
    padding:4px 12px;
    font-size:12px;
}

/* Status Badge */
.badge-active{
    background:#22c55e;
    color:#fff;
    padding:4px 10px;
    border-radius:20px;
    font-size:11px;
}

/* Action buttons container */
.action-btns{
    display:flex;
    gap:8px;
}

/* Q&A Button */
.btn-qa{
    background:#ef4444;
    color:#fff;
    border-radius:8px;
    padding:4px 12px;
    font-size:12px;
}

/* Edit Button */
.btn-edit{
    background:#f59e0b;
    color:#fff;
    border-radius:8px;
    padding:4px 12px;
    font-size:12px;
}

/* Delete Button */
.btn-delete{
    background:#9ca3af;
    color:#fff;
    border-radius:8px;
    padding:4px 12px;
    font-size:12px;
}

/* Light row divider */
.table tbody tr td{
    border-top:none !important;
    border-bottom:1px solid #eee;
}

</style>
@endsection



@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Top Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="d-flex gap-2">
            <input
                type="text"
                class="form-control"
                id="searchInput"
                placeholder="Search here..."
                style="width:220px;"
            >
        </div>

        <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
            + Create Video
        </a>

    </div>



    <!-- Filter -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="mb-0">Created Videos</h5>

        <select class="form-select w-auto" id="departmentFilter">

            <option value="">Filter by Department</option>

            @foreach ($departments as $department)

                <option value="{{ $department->id }}">
                    {{ $department->department_name }}
                </option>

            @endforeach

        </select>

    </div>



    <!-- Table -->
    <div class="card">

        <div class="card-body table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th width="200">Department</th>
                        <th width="120">Document</th>
                        <th width="120">Status</th>
                        <th width="260">Action</th>
                    </tr>

                </thead>



                <tbody id="videoTableBody">

                    @forelse ($videos as $key => $video)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $video->title }}
                            </td>

                            <td>
                                {{ $video->department->department_name ?? '-' }}
                            </td>

                            <td>

                                <a
                                    href="{{ $video->is_link === 'yes'
                                        ? $video->video_link
                                        : $video->video_file }}"
                                    target="_blank"
                                    class="btn btn-view btn-sm"
                                >
                                    View
                                </a>

                            </td>

                            <td>
                                <span class="badge badge-active">
                                    ACTIVE
                                </span>
                            </td>

                            <td>

                                <div class="action-btns">

                                    <a
                                        href="{{ route('admin.video.qa.create',$video->id) }}"
                                        class="btn btn-qa btn-sm"
                                    >
                                        Q&A
                                    </a>

                                    <a
                                        href="{{ route('admin.video.edit',$video->id) }}"
                                        class="btn btn-edit btn-sm"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.video.destroy',$video->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this video?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete btn-sm"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Videos Found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection



@section('script')

<script>

$(document).ready(function(){

    function loadVideos(){

        let search = $('#searchInput').val();
        let departmentId = $('#departmentFilter').val();

        $.ajax({

            url:"{{ route('admin.video.filter') }}",
            type:"GET",

            data:{
                search:search,
                department_id:departmentId
            },

            beforeSend:function(){

                $('#videoTableBody').html(`
                    <tr>
                        <td colspan="6" class="text-center">
                            Loading...
                        </td>
                    </tr>
                `);

            },

            success:function(res){

                let rows = '';

                if(res.data.length > 0){

                    $.each(res.data,function(index,video){

                        let videoUrl = video.is_link === 'yes'
                            ? video.video_link
                            : video.video_file;

                        rows += `

                        <tr>

                            <td>${index+1}</td>

                            <td class="fw-semibold">
                                ${video.title}
                            </td>

                            <td>
                                ${video.department ? video.department.department_name : '-'}
                            </td>

                            <td>
                                <a href="${videoUrl}" target="_blank" class="btn btn-view btn-sm">
                                    View
                                </a>
                            </td>

                            <td>
                                <span class="badge badge-active">
                                    ACTIVE
                                </span>
                            </td>

                            <td>

                                <div class="action-btns">

                                    <a href="/admin/video/qa/create/${video.id}" class="btn btn-qa btn-sm">
                                        Q&A
                                    </a>

                                    <a href="/admin/video/edit/${video.id}" class="btn btn-edit btn-sm">
                                        Edit
                                    </a>

                                    <form action="/admin/video/${video.id}" method="POST">
                                        <button class="btn btn-delete btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                        `;

                    });

                }
                else{

                    rows = `
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Videos Found
                            </td>
                        </tr>
                    `;

                }

                $('#videoTableBody').html(rows);

            }

        });

    }



    $('#searchInput').on('keyup',function(){
        loadVideos();
    });



    $('#departmentFilter').on('change',function(){
        loadVideos();
    });

});

</script>

@endsection