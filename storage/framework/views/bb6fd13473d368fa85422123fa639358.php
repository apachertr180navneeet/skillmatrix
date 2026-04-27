

<?php $__env->startSection('style'); ?>

<!-- SELECT2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        max-width: 900px;
        margin: auto;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
    }

    .form-control,
    .form-select {
        background: #f5f5f5;
        border-radius: 10px;
        padding: 12px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        font-size: 12px;
        color: #dc3545;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 6px;
    }

</style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="container-fluid container-p-y">

    <div class="form-card">

        <form action="<?php echo e(route('company.video.update',$video->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php
            $selectedDepartments = explode(',', $video->department_id);
            ?>


            <!-- TITLE -->
            <div class="mb-4">

                <label class="form-label">Video Title</label>

                <input type="text" name="title" value="<?php echo e(old('title',$video->title)); ?>" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>



            <!-- DEPARTMENT MULTIPLE -->
            <div class="mb-4">

                <label class="form-label">Department</label>

                <select name="department_id[]" id="department_id" multiple class="form-select select2 <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($department->id); ?>" <?php echo e(in_array($department->id,$selectedDepartments) ? 'selected' : ''); ?>>

                        <?php echo e($department->department_name); ?>


                    </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

                <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>



            <!-- VIDEO SOURCE -->
            <div class="mb-4">

                <label class="form-label">Video Source</label>

                <div class="radio-group">

                    <label>
                        <input type="radio" name="is_link" value="yes" <?php echo e(old('is_link',$video->is_link) === 'yes' ? 'checked' : ''); ?>>
                        Video Link
                    </label>

                    <label>
                        <input type="radio" name="is_link" value="no" <?php echo e(old('is_link',$video->is_link) === 'no' ? 'checked' : ''); ?>>
                        Upload Video
                    </label>

                </div>

            </div>



            <!-- VIDEO LINK -->
            <div class="mb-4 d-none" id="videoLinkBox">

                <label class="form-label">Video Link</label>

                <input type="text" name="video_link" value="<?php echo e(old('video_link',$video->video_link)); ?>" class="form-control <?php $__errorArgs = ['video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                <?php $__errorArgs = ['video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>



            <!-- VIDEO UPLOAD -->
            <div class="mb-4" id="videoUploadBox">

                <label class="form-label">Upload Video</label>

                <input type="file" name="video_upload" class="form-control <?php $__errorArgs = ['video_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                <?php if($video->is_link === 'no' && $video->video_file): ?>

                <div class="mt-2">
                    Current Video :
                    <a href="<?php echo e($video->video_file); ?>" target="_blank">View</a>
                </div>

                <?php endif; ?>

                <?php $__errorArgs = ['video_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>



            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label">Description</label>

                <textarea name="description" id="description" rows="5" class="form-control">

                <?php echo e(old('description',$video->description)); ?>


                </textarea>

            </div>



            <!-- IS SUGGESTION -->
            <div class="mb-4">

                <label class="form-label">Is Suggestion</label>

                <div class="radio-group">

                    <label>
                        <input type="radio" name="is_suggestion" value="1" <?php echo e(old('is_suggestion',$video->is_suggestion) == 1 ? 'checked' : ''); ?>>
                        Yes
                    </label>

                    <label>
                        <input type="radio" name="is_suggestion" value="0" <?php echo e(old('is_suggestion',$video->is_suggestion) == 0 ? 'checked' : ''); ?>>
                        No
                    </label>

                </div>

            </div>



            <!-- SUBMIT -->
            <div class="text-end">

                <button class="btn btn-primary">
                    Update Video
                </button>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SELECT2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>


<script>
    $(document).ready(function() {

        /* SELECT2 MULTIPLE */

        $('#department_id').select2({
            placeholder: "Select Department"
            , width: '100%'
        });


        /* VIDEO LINK / UPLOAD TOGGLE */

        const radios = document.querySelectorAll('input[name="is_link"]');
        const linkBox = document.getElementById('videoLinkBox');
        const uploadBox = document.getElementById('videoUploadBox');

        function toggleFields(value) {

            if (value === 'yes') {
                linkBox.classList.remove('d-none');
                uploadBox.classList.add('d-none');
            } else {
                uploadBox.classList.remove('d-none');
                linkBox.classList.add('d-none');
            }

        }

        const checked = document.querySelector('input[name="is_link"]:checked');

        if (checked) {
            toggleFields(checked.value);
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                toggleFields(this.value);
            });
        });


        /* CKEDITOR */

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/video/edit.blade.php ENDPATH**/ ?>