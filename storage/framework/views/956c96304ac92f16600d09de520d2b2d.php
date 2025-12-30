

<?php $__env->startSection('style'); ?>
<style>
    .table-actions .btn {
        padding: 4px 10px;
        font-size: 12px;
        border-radius: 6px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= TOP BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <input type="text"
                   class="form-control"
                   id="searchInput"
                   placeholder="Search here..."
                   style="width:220px;">

            <button class="btn btn-primary" id="searchBtn">
                Search
            </button>
        </div>

        <a href="<?php echo e(route('admin.video.create')); ?>" class="btn btn-primary">
            + Create Video
        </a>
    </div>

    <!-- ================= FILTER BAR ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created Videos</h5>

        <select class="form-select w-auto" id="departmentFilter">
            <option value="">Filter by Department</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($department->id); ?>">
                    <?php echo e($department->department_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- ================= TABLE ================= -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Title</th>
                        <th>Department</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>

                <!-- IMPORTANT ID -->
                <tbody id="videoTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td>
                                <a href="<?php echo e($video->is_link === 'yes'
                                    ? $video->video_link
                                    : $video->video_file); ?>"
                                   target="_blank">
                                    <?php echo e($video->title); ?>

                                </a>
                            </td>
                            <td>
                                <?php echo e($video->department->department_name ?? '-'); ?>

                            </td>
                            <td class="table-actions">
                                <a href="<?php echo e(route('admin.video.qa.create', $video->id)); ?>"
                                   class="btn btn-danger">
                                    Add Q&A
                                </a>

                                <a href="<?php echo e(route('admin.video.edit', $video->id)); ?>"
                                   class="btn btn-warning text-white">
                                    Edit
                                </a>

                                <form action="<?php echo e(route('admin.video.destroy', $video->id)); ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this video?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-secondary">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
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
$(document).ready(function () {

    function loadVideos() {
        let search = $('#searchInput').val();
        let departmentId = $('#departmentFilter').val();

        $.ajax({
            url: "<?php echo e(route('admin.video.filter')); ?>",
            type: "GET",
            data: {
                search: search,
                department_id: departmentId
            },
            beforeSend: function () {
                $('#videoTableBody').html(`
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                `);
            },
            success: function (res) {

                let rows = '';

                if (res.data.length > 0) {
                    $.each(res.data, function (index, video) {

                        let videoUrl = video.is_link === 'yes'
                            ? video.video_link
                            : video.video_file;

                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <a href="${videoUrl}" target="_blank">
                                        ${video.title}
                                    </a>
                                </td>
                                <td>${video.department ? video.department.department_name : '-'}</td>
                                <td class="table-actions">
                                    <a href="/admin/video/qa/create/${video.id}"
                                       class="btn btn-danger">
                                        Add Q&A
                                    </a>

                                    <a href="/admin/video/edit/${video.id}"
                                       class="btn btn-warning text-white">
                                        Edit
                                    </a>

                                    <form action="/admin/video/${video.id}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this video?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-secondary">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rows = `
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No Videos Found
                            </td>
                        </tr>
                    `;
                }

                $('#videoTableBody').html(rows);
            }
        });
    }

    // 🔍 Search click
    $('#searchBtn').on('click', function () {
        loadVideos();
    });

    // ⌨️ Live search
    $('#searchInput').on('keyup', function () {
        loadVideos();
    });

    // 🏷️ Department filter
    $('#departmentFilter').on('change', function () {
        loadVideos();
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/video/index.blade.php ENDPATH**/ ?>