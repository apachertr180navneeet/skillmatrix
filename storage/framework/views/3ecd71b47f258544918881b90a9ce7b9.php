

<?php $__env->startSection('style'); ?>
<style>
    .plan-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 30px 25px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        transition: all .2s ease;
        height: 100%;
        position: relative;
    }
    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.08);
    }
    .plan-card.active {
        border: 2px solid #198754;
        box-shadow: 0 0 0 3px rgba(25,135,84,.15);
    }
    .plan-title { font-size: 20px; font-weight: 600; }
    .plan-price { font-size: 36px; font-weight: 700; color: #4a5d73; }
    .plan-period { color: #8b97a6; font-size: 14px; margin-bottom: 20px; }
    .btn-buy { background: #233447; color: #fff; border-radius: 10px; }
    .btn-buy:hover { background: #1b2938; color: #fff; }
    .current-badge { position: absolute; top: 15px; right: 15px; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">

    <h5 class="fw-bold mb-4">Subscription Plans</h5>

    
    <div class="card mb-4">
        <div class="card-header fw-bold">Purchased Subscriptions</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Used / Total</th>
                        <th>Remaining</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $currentsubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($sub->used_users); ?> / <?php echo e($sub->user_count); ?></td>
                            <td><?php echo e($sub->user_count - $sub->used_users); ?></td>
                            <td>
                                <?php if($sub->is_locked): ?>
                                    <span class="badge bg-danger">Locked</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                No subscriptions purchased yet
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="row g-4 justify-content-center">
        <?php $__currentLoopData = $subcriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                // ⭐ ACTIVE PLAN CHECK
                $isActive = $currentsubscriptions->contains('subscription_plan_id', $subscription->id);
            ?>

            <div class="col-lg-4 col-md-6">
                <div class="plan-card text-center <?php echo e($isActive ? 'active' : ''); ?>">

                    <?php if($isActive): ?>
                        <span class="badge bg-success current-badge">Active Plan</span>
                    <?php endif; ?>

                    <h4 class="plan-title"><?php echo e($subscription->plan_name); ?></h4>

                    <p class="plan-period">
                        Duration: <?php echo e($subscription->duration); ?> days
                    </p>

                    <p class="plan-period">
                        Description: <?php echo e($subscription->description); ?>

                    </p>

                    <h2 class="plan-price">
                        ₹<?php echo e(number_format($subscription->amount, 2)); ?>

                    </h2>

                    <?php if($isActive): ?>
                        <button class="btn btn-success w-100" disabled>
                            ✔ Active
                        </button>
                    <?php else: ?>
                        <button
                            class="btn btn-buy w-100 openBuyModal"
                            data-bs-toggle="modal"
                            data-bs-target="#buyPlanModal"
                            data-plan-id="<?php echo e($subscription->id); ?>"
                            data-plan-name="<?php echo e($subscription->plan_name); ?>"
                            data-plan-amount="<?php echo e($subscription->amount); ?>"
                        >
                            Buy Now
                        </button>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="modal fade" id="buyPlanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Confirm Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" id="buyPlanForm">
                <?php echo csrf_field(); ?>

                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h6 id="modalPlanName"></h6>
                        <h3 class="fw-bold text-primary">
                            ₹<span id="modalPlanAmount">0</span>
                        </h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Number of Users</label>
                        <input type="number" name="user_count" id="userCountInput"
                               class="form-control" min="1" value="1" required>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success px-4">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    let basePrice = 0;

    document.querySelectorAll('.openBuyModal').forEach(btn => {
        btn.onclick = () => {
            basePrice = parseFloat(btn.dataset.planAmount);

            document.getElementById('modalPlanName').innerText = btn.dataset.planName;
            document.getElementById('modalPlanAmount').innerText = basePrice.toFixed(2);
            document.getElementById('buyPlanForm').action =
                "<?php echo e(url('admin/subscription/buy')); ?>/" + btn.dataset.planId;

            document.getElementById('userCountInput').value = 1;
        };
    });

    document.getElementById('userCountInput').addEventListener('input', function () {
        let count = parseInt(this.value) || 1;
        this.value = count;
        document.getElementById('modalPlanAmount').innerText =
            (basePrice * count).toFixed(2);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/bitnami/apache/htdocs/resources/views/admin/subscription/index.blade.php ENDPATH**/ ?>