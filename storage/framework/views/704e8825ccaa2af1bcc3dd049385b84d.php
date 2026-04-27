<?php $__empty_1 = true; $__currentLoopData = $sops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
    <td><?php echo e($index + 1); ?></td>

    <td class="fw-semibold">
        <?php echo e($sop->title); ?>

    </td>

    <td>
        <?php echo e($sop->department_names ?? '-'); ?>

    </td>

    <td>
        <a href="<?php echo e(route('company.sop.view', Crypt::encryptString($sop->id))); ?>" target="_blank" class="btn btn-soft btn-view">
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

            <a href="<?php echo e(route('company.sop.qa.create', $sop->id)); ?>"
               class="btn btn-soft btn-qa">
                Q&amp;A
            </a>

            <a href="<?php echo e(route('company.sop.edit', $sop->id)); ?>"
               class="btn btn-soft btn-edit">
                Edit
            </a>

            <form action="<?php echo e(route('company.sop.destroy', $sop->id)); ?>"
                  method="POST"
                  onsubmit="return confirm('Delete this SOP?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-soft btn-delete">
                    Delete
                </button>
            </form>

        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr>
    <td colspan="6" class="text-center text-muted py-4">
        No SOPs found
    </td>
</tr>
<?php endif; ?>
<?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/sop/table_rows.blade.php ENDPATH**/ ?>