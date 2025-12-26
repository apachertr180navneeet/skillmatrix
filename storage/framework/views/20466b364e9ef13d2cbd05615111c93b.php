

<?php $__env->startSection('style'); ?>
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .video-card {
        background: #fff;
        border-radius: 14px;
        padding: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        height: 100%;
        transition: transform 0.2s ease;
    }

    .video-card:hover {
        transform: translateY(-3px);
    }

    .video-preview {
        height: 150px;
        background: #000;
        border-radius: 10px;
        margin-bottom: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
    }

    .video-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .video-title {
        font-size: 13px;
        font-weight: 600;
        margin: 0;
        flex: 1;
    }

    .btn-group-sm {
        display: flex;
        gap: 6px;
    }

    .play-btn {
        background: #1e78d6;
        color: #fff;
        font-size: 11px;
        padding: 5px 10px;
        border-radius: 6px;
        border: none;
        text-decoration: none;
        white-space: nowrap;
    }

    .play-btn:hover {
        background: #155fa0;
        color: #fff;
    }

    .qa-btn {
        background: #dc3545;
        color: #fff;
        font-size: 11px;
        padding: 5px 10px;
        border-radius: 6px;
        border: none;
        text-decoration: none;
        white-space: nowrap;
    }

    .qa-btn:hover {
        background: #bb2d3b;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid flex-grow-1 container-p-y">

    <!-- HEADER -->
    <div class="page-header">
        <h5 class="mb-0">Training Videos</h5>
        <div>
            <button class="btn btn-primary btn-sm me-2">Sort</button>
            <button class="btn btn-primary btn-sm">View</button>
        </div>
    </div>

    <!-- VIDEO LIST -->
    <div class="row g-4">

        <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

                <div class="video-card">

                    <!-- VIDEO PREVIEW -->
                    <a href="<?php echo e($video->is_link === 'yes'
                                ? $video->video_link
                                : $video->video_file); ?>"
                        target="_blank">
                        <div class="video-preview">
                            ▶ Play Video
                        </div>
                    </a>

                    <!-- FOOTER -->
                    <div class="video-footer">
                        <p class="video-title">
                            <?php echo e($video->title ?? 'Training Video'); ?>

                        </p>

                        <div class="btn-group-sm">
                            <!-- WATCH BUTTON -->
                            <a href="<?php echo e($video->video_file); ?>"
                               target="_blank"
                               class="play-btn">
                                Watch
                            </a>

                            <!-- Q&A BUTTON -->
                            <a href="<?php echo e(route('user.video.qa', $video->id)); ?>"
                               class="qa-btn">
                                Q&amp;A
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No videos found for your department.
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/video/index.blade.php ENDPATH**/ ?>