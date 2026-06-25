

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

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

        <a href="<?php echo e(route('company.video.create')); ?>" class="btn btn-primary">
            + Create Video
        </a>

    </div>



    <!-- Filter -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="mb-0">Created Videos</h5>

        <select class="form-select w-auto" id="departmentFilter">

            <option value="">Filter by Department</option>

            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($department->id); ?>">
                    <?php echo e($department->department_name); ?>

                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

                    <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td><?php echo e($key + 1); ?></td>

                            <td class="fw-semibold">
                                <?php echo e($video->title); ?>

                            </td>

                            <td>
                                <?php echo e($video->department_names ?? '-'); ?>

                            </td>

                            <td>

                                <a
                                    href="<?php echo e($video->is_link === 'yes'
                                        ? $video->video_link
                                        : $video->video_file); ?>"
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
                                        href="<?php echo e(route('company.video.qa.create',$video->id)); ?>"
                                        class="btn btn-qa btn-sm"
                                    >
                                        Q&A
                                    </a>

                                    <a
                                        href="<?php echo e(route('company.video.edit',$video->id)); ?>"
                                        class="btn btn-edit btn-sm"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?php echo e(route('company.video.destroy',$video->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Delete this video?')"
                                    >

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

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

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Videos Found
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

<script>

$(document).ready(function(){

    function loadVideos(){

        let search = $('#searchInput').val();
        let departmentId = $('#departmentFilter').val();

        $.ajax({

            url:"<?php echo e(route('company.video.filter')); ?>",
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
                                ${video.department_names ? video.department_names : '-'}
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

                                    <a href="/admin/videos/qa/create/${video.id}" class="btn btn-qa btn-sm">
                                        Q&A
                                    </a>

                                    <a href="/admin/videos/${video.id}/edit" class="btn btn-edit btn-sm">
                                        Edit
                                    </a>

                                    <form action="/admin/videos/${video.id}" method="POST">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/video/index.blade.php ENDPATH**/ ?>