

<?php $__env->startSection('style'); ?>

<!-- Select2 CSS -->
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
        padding: 12px 14px;
        font-size: 14px;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        font-size: 12px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
    }

    .radio-box {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .submit-btn {
        background: #1e78d6;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        color: #fff;
    }

    .ck-editor__editable {
        min-height: 180px;
    }

    /* select2 design */
    .select2-container--default .select2-selection--multiple {
        background: #f5f5f5;
        border-radius: 10px;
        border: 2px solid transparent;
        padding: 6px;
    }

</style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid container-p-y">

    <div class="form-card">

        <form action="<?php echo e(route('company.sop.update',$sop->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php
            $selectedDepartments = explode(',', $sop->department_id);
            ?>


            <!-- SOP TITLE -->

            <div class="mb-4">

                <label class="form-label">SOP Title</label>

                <input type="text" name="title" value="<?php echo e(old('title',$sop->title)); ?>" class="form-control <?php $__errorArgs = ['title'];
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



            <!-- DEPARTMENT SELECT2 MULTI SELECT -->

            <div class="mb-4">

                <label class="form-label">Department</label>

                <select name="department_id[]" class="form-select select2 <?php $__errorArgs = ['department_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple>

                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($department->id); ?>" <?php echo e(in_array($department->id, old('department_id',$selectedDepartments)) ? 'selected' : ''); ?>>

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



            <!-- SOP FILE -->

            <div class="mb-4">

                <label class="form-label">SOP File Upload</label>

                <input type="file" name="sop_upload" class="form-control <?php $__errorArgs = ['sop_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                <?php if($sop->sop_upload): ?>

                <p class="mt-2">
                    Current File :
                    <a href="<?php echo e(route('company.sop.view', Crypt::encryptString($sop->id))); ?>" target="_blank">
                        View SOP
                    </a>
                </p>

                <?php endif; ?>

                <?php $__errorArgs = ['sop_upload'];
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

                <textarea name="description" id="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

                <?php echo e(old('description',$sop->description)); ?>


                </textarea>

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
                        <input type="radio" name="is_suggestion" value="1" <?php echo e(old('is_suggestion',$sop->is_suggestion)==1 ? 'checked':''); ?>>
                        Yes
                    </label>

                    <label class="radio-box">
                        <input type="radio" name="is_suggestion" value="0" <?php echo e(old('is_suggestion',$sop->is_suggestion)==0 ? 'checked':''); ?>>
                        No
                    </label>

                </div>

            </div>



            <!-- SUBMIT -->

            <div class="text-end">

                <button type="submit" class="submit-btn">
                    Update SOP
                </button>

            </div>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: "Select Department"
            , width: '100%'
        });

    });


    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/sop/edit.blade.php ENDPATH**/ ?>