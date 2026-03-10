

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="text-center">View Video</h5>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form>

                <div class="row mb-3">
                    <!-- Date -->
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e(\Carbon\Carbon::parse($video->created_at)->format('d-m-Y')); ?>"
                               readonly>
                    </div>

                    <!-- Video Title -->
                    <div class="col-md-3">
                        <label class="form-label">Video Title</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($video->title); ?>"
                               readonly>
                    </div>

                    <!-- Department -->
                    <div class="col-md-3">
                        <label class="form-label">Department</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($video->department->department_name ?? '-'); ?>"
                               readonly>
                    </div>

                    <!-- Company -->
                    <div class="col-md-3">
                        <label class="form-label">Company</label>
                        <input type="text"
                               class="form-control"
                               value="<?php echo e($video->company->name ?? '-'); ?>"
                               readonly>
                    </div>
                </div>

                <!-- Video Section -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Video</label>

                        <?php if($video->video_file): ?>
                            <?php if(Str::contains($video->video_file, 'youtube')): ?>
                                
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.youtube.com/embed/<?php echo e(\Illuminate\Support\Str::after($video->video_file, 'v=')); ?>"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            <?php else: ?>
                                
                                <video width="100%" controls>
                                    <source src="<?php echo e(asset('storage/'.$video->video_file)); ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-muted">No video available</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="<?php echo e(route('super.admin.video.index')); ?>"
                           class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/super_admin/video/show.blade.php ENDPATH**/ ?>