

<?php $__env->startSection('style'); ?>
<style>
    /* ================= FORM CARD ================= */
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        max-width: 900px;
        margin: auto;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        background: #f5f5f5;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
    }

    textarea.form-control {
        resize: none;
    }

    /* ================= ERROR ================= */
    .is-invalid {
        border-color: #dc3545 !important;
        background: #fff5f5;
    }

    .invalid-feedback {
        font-size: 12px;
        color: #dc3545;
        margin-top: 4px;
    }

    /* ================= RADIO ================= */
    .radio-group {
        display: flex;
        gap: 25px;
        margin-top: 8px;
    }

    .radio-box {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .radio-box input {
        accent-color: #1e78d6;
    }

    /* ================= BUTTON ================= */
    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 28px;
        border-radius: 8px;
        color: #fff;
        font-size: 14px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="form-card">
        <form action="<?php echo e(route('admin.video.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <!-- VIDEO TITLE -->
            <div class="mb-4">
                <label class="form-label">Video Title</label>
                <input type="text"
                       name="title"
                       class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('title')); ?>"
                       placeholder="Video title">
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

            <!-- DEPARTMENT -->
            <div class="mb-4">
                <label class="form-label">Department</label>
                <select name="department_id"
                        class="form-select <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">Select Department</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($department->id); ?>"
                            <?php echo e(old('department_id') == $department->id ? 'selected' : ''); ?>>
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
                    <label class="radio-box">
                        <input type="radio" name="is_link" value="yes"
                            <?php echo e(old('is_link') == 'yes' ? 'checked' : ''); ?>>
                        Video Link
                    </label>

                    <label class="radio-box">
                        <input type="radio" name="is_link" value="no"
                            <?php echo e(old('is_link', 'no') == 'no' ? 'checked' : ''); ?>>
                        Upload Video
                    </label>
                </div>
                <?php $__errorArgs = ['is_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- VIDEO LINK -->
            <div class="mb-4 d-none" id="videoLinkBox">
                <label class="form-label">Video Link</label>
                <input type="text"
                       name="video_link"
                       class="form-control <?php $__errorArgs = ['video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('video_link')); ?>"
                       placeholder="https://youtube.com/...">
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
                <label class="form-label">Upload Video File</label>
                <input type="file"
                       name="video_upload"
                       class="form-control <?php $__errorArgs = ['video_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
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

            <!-- DESCRIPTION (CKEDITOR) -->
            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea name="description"
                          id="description"
                          rows="5"
                          class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="Video description"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
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

            <!-- IS SUGGESTION -->
            <div class="mb-4">
                <label class="form-label">Is Suggestion</label>
                <div class="radio-group">
                    <label class="radio-box">
                        <input type="radio"
                               name="is_suggestion"
                               value="1"
                               <?php echo e(old('is_suggestion') == '1' ? 'checked' : ''); ?>>
                        Yes
                    </label>

                    <label class="radio-box">
                        <input type="radio"
                               name="is_suggestion"
                               value="0"
                               <?php echo e(old('is_suggestion', '0') == '0' ? 'checked' : ''); ?>>
                        No
                    </label>
                </div>
                <?php $__errorArgs = ['is_suggestion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- SUBMIT -->
            <div class="text-end">
                <button type="submit" class="submit-btn">Save Video</button>
            </div>

        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<!-- CKEDITOR 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ================= CKEDITOR ================= */
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'blockQuote',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });

    /* ================= VIDEO SOURCE TOGGLE ================= */
    const radios = document.querySelectorAll('input[name="is_link"]');
    const linkBox = document.getElementById('videoLinkBox');
    const uploadBox = document.getElementById('videoUploadBox');

    function toggleField(value) {
        if (value === 'yes') {
            linkBox.classList.remove('d-none');
            uploadBox.classList.add('d-none');
        } else {
            uploadBox.classList.remove('d-none');
            linkBox.classList.add('d-none');
        }
    }

    const selected = document.querySelector('input[name="is_link"]:checked');
    if (selected) {
        toggleField(selected.value);
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            toggleField(this.value);
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/video/create.blade.php ENDPATH**/ ?>