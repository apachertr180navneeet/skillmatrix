<?php $__env->startSection('style'); ?>
<style>
    :root {
        --user-dashboard-ink: #16324a;
        --user-dashboard-muted: #6f8195;
        --user-dashboard-line: rgba(22, 50, 74, 0.1);
        --user-dashboard-surface: rgba(255, 255, 255, 0.92);
        --user-dashboard-bg: linear-gradient(180deg, #f3f8ff 0%, #fbfdff 48%, #f5f7fb 100%);
        --user-dashboard-shadow: 0 18px 40px rgba(16, 45, 76, 0.08);
    }

    .user-dashboard {
        position: relative;
        padding: 28px;
        border-radius: 28px;
        background: var(--user-dashboard-bg);
        overflow: hidden;
    }

    .user-dashboard::before,
    .user-dashboard::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
    }

    .user-dashboard::before {
        width: 320px;
        height: 320px;
        top: -150px;
        right: -90px;
        background: radial-gradient(circle, rgba(31, 128, 223, 0.22) 0%, rgba(31, 128, 223, 0) 72%);
    }

    .user-dashboard::after {
        width: 280px;
        height: 280px;
        bottom: -140px;
        left: -80px;
        background: radial-gradient(circle, rgba(0, 184, 148, 0.16) 0%, rgba(0, 184, 148, 0) 70%);
    }

    .dashboard-stack {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 24px;
    }

    .dashboard-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(280px, 0.9fr);
        gap: 22px;
    }

    .hero-card,
    .spotlight-card,
    .section-card,
    .stat-card {
        background: var(--user-dashboard-surface);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: var(--user-dashboard-shadow);
        backdrop-filter: blur(14px);
    }

    .hero-card {
        border-radius: 28px;
        padding: 30px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(31, 128, 223, 0.12);
        color: #1c67af;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .hero-title {
        margin: 18px 0 10px;
        font-size: 34px;
        line-height: 1.15;
        font-weight: 800;
        color: var(--user-dashboard-ink);
    }

    .hero-title span {
        color: #1f80df;
    }

    .hero-copy {
        max-width: 680px;
        margin: 0;
        color: var(--user-dashboard-muted);
        font-size: 15px;
        line-height: 1.75;
    }

    .hero-toolbar {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .hero-search {
        flex: 1 1 320px;
        min-height: 52px;
        border-radius: 16px;
        border: 1px solid var(--user-dashboard-line);
        background: #f8fbff;
        padding: 0 18px;
        box-shadow: none;
    }

    .hero-search:focus {
        background: #fff;
        border-color: rgba(31, 128, 223, 0.35);
        box-shadow: 0 0 0 0.2rem rgba(31, 128, 223, 0.1);
    }

    .hero-button {
        min-height: 52px;
        border: 0;
        border-radius: 16px;
        padding: 0 22px;
        background: linear-gradient(135deg, #173f70 0%, #1f80df 100%);
        color: #fff;
        font-weight: 700;
        letter-spacing: 0.02em;
        box-shadow: 0 16px 28px rgba(31, 128, 223, 0.24);
    }

    .hero-highlights {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 24px;
    }

    .highlight-tile {
        border-radius: 20px;
        padding: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #f5f9ff 100%);
        border: 1px solid rgba(22, 50, 74, 0.08);
    }

    .highlight-tile span {
        display: block;
        margin-bottom: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #738da9;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .highlight-tile strong {
        display: block;
        font-size: 28px;
        line-height: 1;
        color: var(--user-dashboard-ink);
        font-weight: 800;
    }

    .highlight-tile small {
        display: block;
        margin-top: 8px;
        color: var(--user-dashboard-muted);
        font-size: 13px;
    }

    .spotlight-card {
        border-radius: 28px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .spotlight-card::before {
        content: "";
        position: absolute;
        right: -55px;
        bottom: -55px;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 179, 71, 0.24) 0%, rgba(255, 179, 71, 0) 72%);
    }

    .spotlight-label {
        margin-bottom: 10px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #8a6b16;
    }

    .spotlight-total {
        font-size: 48px;
        font-weight: 800;
        line-height: 1;
        color: var(--user-dashboard-ink);
    }

    .spotlight-title {
        margin: 12px 0 8px;
        font-size: 20px;
        font-weight: 700;
        color: var(--user-dashboard-ink);
    }

    .spotlight-copy {
        margin: 0;
        color: var(--user-dashboard-muted);
        line-height: 1.7;
    }

    .spotlight-progress {
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid rgba(22, 50, 74, 0.08);
    }

    .spotlight-progress .meta {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 13px;
        color: var(--user-dashboard-muted);
        margin-bottom: 10px;
    }

    .spotlight-progress .progress {
        height: 10px;
        border-radius: 999px;
        background: rgba(22, 50, 74, 0.08);
    }

    .spotlight-progress .progress-bar {
        border-radius: 999px;
        background: linear-gradient(90deg, #ffb347 0%, #ff8c42 100%);
    }

    .section-card {
        border-radius: 26px;
        padding: 24px;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-title {
        margin: 0;
        color: var(--user-dashboard-ink);
        font-size: 20px;
        font-weight: 800;
    }

    .section-copy {
        margin: 6px 0 0;
        color: var(--user-dashboard-muted);
        font-size: 14px;
    }

    .section-link {
        color: #1f80df;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .quick-card {
        display: block;
        border-radius: 22px;
        padding: 22px;
        text-decoration: none;
        color: inherit;
        border: 1px solid rgba(22, 50, 74, 0.08);
        background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .quick-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 28px rgba(16, 45, 76, 0.1);
        border-color: rgba(31, 128, 223, 0.18);
        color: inherit;
    }

    .quick-icon {
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        color: #fff;
        font-size: 24px;
        margin-bottom: 18px;
    }

    .quick-icon.sop {
        background: linear-gradient(135deg, #2f80ed 0%, #56ccf2 100%);
    }

    .quick-icon.checklist {
        background: linear-gradient(135deg, #00b894 0%, #55efc4 100%);
    }

    .quick-icon.video {
        background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
    }

    .quick-card h6 {
        margin-bottom: 8px;
        color: var(--user-dashboard-ink);
        font-size: 18px;
        font-weight: 700;
    }

    .quick-card p {
        margin: 0;
        color: var(--user-dashboard-muted);
        line-height: 1.65;
        font-size: 14px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .stat-card {
        border-radius: 22px;
        padding: 22px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        color: #fff;
        font-size: 24px;
    }

    .stat-icon.total-tests {
        background: linear-gradient(135deg, #1d70d3 0%, #3ea7ff 100%);
    }

    .stat-icon.sop-total {
        background: linear-gradient(135deg, #188f73 0%, #34d1aa 100%);
    }

    .stat-icon.checklist-total {
        background: linear-gradient(135deg, #7b61ff 0%, #a38bff 100%);
    }

    .stat-icon.video-total {
        background: linear-gradient(135deg, #ef8d32 0%, #ffbe64 100%);
    }

    .stat-content span {
        display: block;
        color: var(--user-dashboard-muted);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .stat-content h6 {
        margin: 0 0 6px;
        color: var(--user-dashboard-ink);
        font-size: 17px;
        font-weight: 700;
    }

    .stat-content p {
        margin: 0;
        font-size: 28px;
        line-height: 1;
        font-weight: 800;
        color: var(--user-dashboard-ink);
    }

    @media (max-width: 1199.98px) {
        .dashboard-hero,
        .quick-actions,
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-hero {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .user-dashboard {
            padding: 18px;
            border-radius: 22px;
        }

        .hero-card,
        .spotlight-card,
        .section-card {
            padding: 20px;
            border-radius: 22px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-highlights,
        .quick-actions,
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .hero-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-button {
            width: 100%;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="user-dashboard">
        <div class="dashboard-stack">
            <div class="dashboard-hero">
                <div class="hero-card">
                    <div class="hero-badge">
                        <i class="bx bx-line-chart"></i>
                        Performance Dashboard
                    </div>

                    <h1 class="hero-title">
                        Welcome back, <span><?php echo e(Auth::user()->full_name); ?></span>
                    </h1>

                    <p class="hero-copy">
                        Track your learning activity, jump into pending assessments, and review how your SOP,
                        checklist, and video evaluations are building up across the platform.
                    </p>

                    <div class="hero-highlights">
                        <div class="highlight-tile">
                            <span>Total Exams</span>
                            <strong><?php echo e($totalTest); ?></strong>
                            <small>All assessments attempted</small>
                        </div>
                        <div class="highlight-tile">
                            <span>SOP Checks</span>
                            <strong><?php echo e($sopResultTotal); ?></strong>
                            <small>Completed SOP evaluations</small>
                        </div>
                        <div class="highlight-tile">
                            <span>Video Checks</span>
                            <strong><?php echo e($vedioResultTotal); ?></strong>
                            <small>Submitted video reviews</small>
                        </div>
                    </div>
                </div>

                <div class="spotlight-card">
                    <div class="spotlight-label">Snapshot</div>
                    <div class="spotlight-total"><?php echo e($totalTest); ?></div>
                    <div class="spotlight-title">Your activity overview</div>
                    <p class="spotlight-copy">
                        You have engaged with <?php echo e($sopResultTotal + $checklistResultTotal + $vedioResultTotal); ?> tracked review records across the learning workflow.
                    </p>

                    <?php
                        $completedTotal = $sopResultTotal + $checklistResultTotal + $vedioResultTotal;
                        $progressValue = $totalTest > 0 ? min(100, round(($completedTotal / $totalTest) * 100)) : 0;
                    ?>

                    <div class="spotlight-progress">
                        <div class="meta">
                            <span>Completion pulse</span>
                            <span><?php echo e($progressValue); ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo e($progressValue); ?>%" aria-valuenow="<?php echo e($progressValue); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-card">
                <div class="section-head">
                    <div>
                        <h5 class="section-title">Quick Actions</h5>
                        <p class="section-copy">Move directly into the modules you use most often.</p>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="<?php echo e(route('user.sop')); ?>" class="quick-card">
                        <div class="quick-icon sop">
                            <i class="bx bx-file"></i>
                        </div>
                        <h6>SOP Module</h6>
                        <p>Open standard operating procedure tasks and continue your assigned checks.</p>
                    </a>

                    <a href="<?php echo e(route('user.checklist')); ?>" class="quick-card">
                        <div class="quick-icon checklist">
                            <i class="bx bx-list-check"></i>
                        </div>
                        <h6>Checklist Module</h6>
                        <p>Review checklist-based assessments and keep your operational tracking current.</p>
                    </a>

                    <a href="<?php echo e(route('user.video')); ?>" class="quick-card">
                        <div class="quick-icon video">
                            <i class="bx bx-video"></i>
                        </div>
                        <h6>Video Module</h6>
                        <p>Access video evaluations, playback tasks, and submit the next review step.</p>
                    </a>
                </div>
            </div>

            <div class="section-card">
                <div class="section-head">
                    <div>
                        <h5 class="section-title">Overview Metrics</h5>
                        <p class="section-copy">A compact view of your current activity counts.</p>
                    </div>
                    <a href="<?php echo e(route('user.sop.results')); ?>" class="section-link">View results</a>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon total-tests">
                            <i class="bx bx-task"></i>
                        </div>
                        <div class="stat-content">
                            <span>Assessments</span>
                            <h6>Total Exam Applied</h6>
                            <p><?php echo e($totalTest); ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon sop-total">
                            <i class="bx bx-file-find"></i>
                        </div>
                        <div class="stat-content">
                            <span>SOP Reviews</span>
                            <h6>Total SOP Check</h6>
                            <p><?php echo e($sopResultTotal); ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon checklist-total">
                            <i class="bx bx-check-square"></i>
                        </div>
                        <div class="stat-content">
                            <span>Checklist Reviews</span>
                            <h6>Total Checklist</h6>
                            <p><?php echo e($checklistResultTotal); ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon video-total">
                            <i class="bx bx-play-circle"></i>
                        </div>
                        <div class="stat-content">
                            <span>Video Reviews</span>
                            <h6>Total Video Check</h6>
                            <p><?php echo e($vedioResultTotal); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.userlayouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/web/dashboard/index.blade.php ENDPATH**/ ?>