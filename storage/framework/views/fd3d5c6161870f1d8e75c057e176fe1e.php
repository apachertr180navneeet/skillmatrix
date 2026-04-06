<?php $__env->startSection('style'); ?>
<style>
    .dashboard-shell {
        position: relative;
        overflow: hidden;
    }

    .dashboard-shell::before,
    .dashboard-shell::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(10px);
        opacity: 0.7;
    }

    .dashboard-shell::before {
        width: 260px;
        height: 260px;
        background: rgba(255, 122, 0, 0.18);
        top: -90px;
        right: -80px;
    }

    .dashboard-shell::after {
        width: 220px;
        height: 220px;
        background: rgba(12, 166, 120, 0.14);
        bottom: -70px;
        left: -70px;
    }

    .hero-panel {
        position: relative;
        z-index: 1;
        padding: 32px;
        border-radius: 28px;
        background:
            radial-gradient(circle at top right, rgba(255, 255, 255, 0.22), transparent 32%),
            linear-gradient(135deg, #0b132b 0%, #1c2541 45%, #3a506b 100%);
        color: #fff;
        box-shadow: 0 24px 70px rgba(14, 22, 44, 0.22);
    }

    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .hero-title {
        margin: 18px 0 10px;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.15;
        color: #fff;
    }

    .hero-text {
        max-width: 640px;
        margin: 0;
        color: rgba(255, 255, 255, 0.78);
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-stats {
        margin-top: 26px;
    }

    .hero-mini-card {
        padding: 18px 20px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        height: 100%;
    }

    .hero-mini-label {
        display: block;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.72);
        font-size: 12px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .hero-mini-value {
        font-size: 28px;
        font-weight: 700;
        line-height: 1;
        color: #fff;
    }

    .hero-mini-note {
        margin-top: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.74);
    }

    .overview-strip {
        position: relative;
        z-index: 1;
        margin-top: -26px;
        padding: 0 16px;
    }

    .overview-panel {
        padding: 18px 22px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 18px 45px rgba(31, 45, 61, 0.12);
    }

    .overview-pill {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 18px;
        background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%);
        height: 100%;
    }

    .overview-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .overview-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #7b8794;
    }

    .overview-value {
        display: block;
        margin-top: 3px;
        font-size: 21px;
        font-weight: 700;
        color: #14213d;
    }

    .dashboard-grid {
        position: relative;
        z-index: 1;
        margin-top: 26px;
    }

    .metric-card {
        position: relative;
        overflow: hidden;
        height: 100%;
        padding: 24px;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 26px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .metric-card::before {
        content: "";
        position: absolute;
        inset: 0 auto auto 0;
        width: 100%;
        height: 4px;
        background: var(--card-accent);
    }

    .metric-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 26px 48px rgba(15, 23, 42, 0.14);
    }

    .metric-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 26px;
    }

    .metric-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--card-soft);
        color: var(--card-ink);
        font-size: 24px;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.35);
    }

    .metric-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef2ff;
        color: #4c51bf;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .metric-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #172033;
    }

    .metric-subtitle {
        margin: 9px 0 0;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.6;
    }

    .metric-value {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        margin-top: 26px;
    }

    .metric-number {
        font-size: 38px;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .metric-caption {
        padding-bottom: 5px;
        color: #8a94a6;
        font-size: 13px;
        font-weight: 600;
    }

    .metric-breakdown {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-top: 24px;
    }

    .metric-breakdown-item {
        padding: 14px;
        border-radius: 16px;
        background: #f8fafc;
    }

    .metric-breakdown-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #94a3b8;
    }

    .metric-breakdown-value {
        display: block;
        margin-top: 6px;
        font-size: 22px;
        font-weight: 700;
        color: #111827;
    }

    @media (max-width: 991.98px) {
        .hero-panel {
            padding: 24px;
        }

        .hero-title {
            font-size: 28px;
        }

        .overview-strip {
            margin-top: 18px;
            padding: 0;
        }
    }

    @media (max-width: 575.98px) {
        .hero-panel,
        .overview-panel,
        .metric-card {
            border-radius: 20px;
        }

        .hero-title {
            font-size: 24px;
        }

        .metric-number {
            font-size: 32px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $departmentActive = $departmentStats->active ?? 0;
    $departmentInactive = $departmentStats->inactive ?? 0;
    $departmentTotal = $departmentActive + $departmentInactive;
    $contentAssets = $sopcount + $checklistCount + $videoCount;
    $engagementTotal = $totalquesans + $totalresult;
    $metrics = [
        [
            'title' => 'Admin Management',
            'subtitle' => 'Control platform operators and access ownership across the system.',
            'value' => $adminCount,
            'label' => 'Admins',
            'icon' => 'bx-shield-quarter',
            'tag' => 'Access',
            'accent' => 'linear-gradient(90deg, #ff7a00 0%, #ffb347 100%)',
            'soft' => 'linear-gradient(135deg, #fff1e6 0%, #ffe2c1 100%)',
            'ink' => '#c05621',
        ],
        [
            'title' => 'User Management',
            'subtitle' => 'Track onboarded users and keep the ecosystem active and organized.',
            'value' => $userCount,
            'label' => 'Users',
            'icon' => 'bx-user-circle',
            'tag' => 'People',
            'accent' => 'linear-gradient(90deg, #2563eb 0%, #38bdf8 100%)',
            'soft' => 'linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%)',
            'ink' => '#1d4ed8',
        ],
        [
            'title' => 'Department Management',
            'subtitle' => 'Monitor active and inactive departments from one place.',
            'value' => $departmentTotal,
            'label' => 'Departments',
            'icon' => 'bx-buildings',
            'tag' => 'Structure',
            'accent' => 'linear-gradient(90deg, #0f766e 0%, #2dd4bf 100%)',
            'soft' => 'linear-gradient(135deg, #d1fae5 0%, #ccfbf1 100%)',
            'ink' => '#0f766e',
            'breakdown' => [
                ['label' => 'Active', 'value' => $departmentActive],
                ['label' => 'Inactive', 'value' => $departmentInactive],
            ],
        ],
        [
            'title' => 'SOP Management',
            'subtitle' => 'Measure how much operational knowledge is available to teams.',
            'value' => $sopcount,
            'label' => 'SOPs',
            'icon' => 'bx-book-content',
            'tag' => 'Knowledge',
            'accent' => 'linear-gradient(90deg, #7c3aed 0%, #c084fc 100%)',
            'soft' => 'linear-gradient(135deg, #ede9fe 0%, #f5d0fe 100%)',
            'ink' => '#7c3aed',
        ],
        [
            'title' => 'Checklist Management',
            'subtitle' => 'Keep verification flows visible and consistent for daily execution.',
            'value' => $checklistCount,
            'label' => 'Checklists',
            'icon' => 'bx-task',
            'tag' => 'Process',
            'accent' => 'linear-gradient(90deg, #db2777 0%, #fb7185 100%)',
            'soft' => 'linear-gradient(135deg, #fce7f3 0%, #ffe4e6 100%)',
            'ink' => '#be185d',
        ],
        [
            'title' => 'Video Management',
            'subtitle' => 'See how much visual training content is ready for distribution.',
            'value' => $videoCount,
            'label' => 'Videos',
            'icon' => 'bx-play-circle',
            'tag' => 'Media',
            'accent' => 'linear-gradient(90deg, #ea580c 0%, #fb923c 100%)',
            'soft' => 'linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%)',
            'ink' => '#c2410c',
        ],
        [
            'title' => 'Q&A Management',
            'subtitle' => 'Track interactive learning material available across modules.',
            'value' => $totalquesans,
            'label' => 'Q&A Sets',
            'icon' => 'bx-message-rounded-dots',
            'tag' => 'Assess',
            'accent' => 'linear-gradient(90deg, #0891b2 0%, #22d3ee 100%)',
            'soft' => 'linear-gradient(135deg, #cffafe 0%, #e0f2fe 100%)',
            'ink' => '#0e7490',
        ],
        [
            'title' => 'Result Management',
            'subtitle' => 'Review recorded outcomes and progress evidence generated by users.',
            'value' => $totalresult,
            'label' => 'Results',
            'icon' => 'bx-bar-chart-alt-2',
            'tag' => 'Progress',
            'accent' => 'linear-gradient(90deg, #4f46e5 0%, #818cf8 100%)',
            'soft' => 'linear-gradient(135deg, #e0e7ff 0%, #eef2ff 100%)',
            'ink' => '#4338ca',
        ],
        [
            'title' => 'Subscription Plans',
            'subtitle' => 'Watch the commercial layer that powers package and plan management.',
            'value' => $subcriptionPlans,
            'label' => 'Plans',
            'icon' => 'bx-credit-card-front',
            'tag' => 'Revenue',
            'accent' => 'linear-gradient(90deg, #15803d 0%, #4ade80 100%)',
            'soft' => 'linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%)',
            'ink' => '#166534',
        ],
    ];
?>

<div class="container-fluid flex-grow-1 container-p-y dashboard-shell">
    <div class="hero-panel">
        <span class="hero-kicker">
            <i class="bx bx-command"></i>
            Super Admin Control Center
        </span>

        <div class="row align-items-end g-4">
            <div class="col-lg-7">
                <h1 class="hero-title">A sharper view of your Skill Matrix operations.</h1>
                <p class="hero-text">
                    Monitor users, departments, content libraries, assessment activity, and subscription growth from a single high-visibility dashboard designed for faster executive scanning.
                </p>
            </div>
        </div>
    </div>


    <div class="row g-4 dashboard-grid">
        <?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-md-6">
                <div
                    class="metric-card"
                    style="--card-accent: <?php echo e($metric['accent']); ?>; --card-soft: <?php echo e($metric['soft']); ?>; --card-ink: <?php echo e($metric['ink']); ?>;"
                >
                    <div class="metric-card-head">
                        <span class="metric-icon">
                            <i class="bx <?php echo e($metric['icon']); ?>"></i>
                        </span>
                        <span class="metric-tag"><?php echo e($metric['tag']); ?></span>
                    </div>

                    <h3 class="metric-title"><?php echo e($metric['title']); ?></h3>
                    <p class="metric-subtitle"><?php echo e($metric['subtitle']); ?></p>

                    <div class="metric-value">
                        <span class="metric-number"><?php echo e($metric['value']); ?></span>
                        <span class="metric-caption"><?php echo e($metric['label']); ?></span>
                    </div>

                    <?php if(!empty($metric['breakdown'])): ?>
                        <div class="metric-breakdown">
                            <?php $__currentLoopData = $metric['breakdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="metric-breakdown-item">
                                    <span class="metric-breakdown-label"><?php echo e($item['label']); ?></span>
                                    <span class="metric-breakdown-value"><?php echo e($item['value']); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('super_admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/super_admin/dashboard/index.blade.php ENDPATH**/ ?>