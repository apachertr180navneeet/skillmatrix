<?php $__env->startSection('style'); ?>
<style>
    :root {
        --dashboard-ink: #17324d;
        --dashboard-muted: #6a7b8f;
        --dashboard-line: rgba(23, 50, 77, 0.08);
        --dashboard-surface: #ffffff;
        --dashboard-bg: linear-gradient(180deg, #f3f8ff 0%, #fbfdff 46%, #f5f7fb 100%);
        --dashboard-shadow: 0 18px 45px rgba(22, 42, 69, 0.08);
    }

    .dashboard-shell {
        padding: 28px;
        border-radius: 28px;
        background: var(--dashboard-bg);
        position: relative;
        overflow: hidden;
    }

    .dashboard-shell::before,
    .dashboard-shell::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
    }

    .dashboard-shell::before {
        width: 280px;
        height: 280px;
        top: -120px;
        right: -80px;
        background: radial-gradient(circle, rgba(46, 125, 255, 0.20) 0%, rgba(46, 125, 255, 0) 70%);
    }

    .dashboard-shell::after {
        width: 260px;
        height: 260px;
        bottom: -140px;
        left: -100px;
        background: radial-gradient(circle, rgba(4, 176, 133, 0.16) 0%, rgba(4, 176, 133, 0) 70%);
    }

    .dashboard-hero {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(320px, 0.9fr);
        gap: 22px;
        margin-bottom: 26px;
    }

    .hero-panel,
    .focus-panel,
    .stats-panel {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow: var(--dashboard-shadow);
        backdrop-filter: blur(14px);
    }

    .hero-panel {
        padding: 28px;
        border-radius: 26px;
        min-height: 240px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(23, 120, 214, 0.10);
        color: #165595;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .hero-title {
        margin: 16px 0 10px;
        font-size: 34px;
        line-height: 1.15;
        font-weight: 800;
        color: var(--dashboard-ink);
    }

    .hero-subtitle {
        max-width: 700px;
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 15px;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .hero-search {
        flex: 1 1 320px;
        min-height: 52px;
        border: 1px solid rgba(23, 50, 77, 0.10);
        border-radius: 16px;
        background: #f8fbff;
        padding: 0 18px;
        box-shadow: none;
    }

    .hero-search:focus {
        border-color: rgba(30, 120, 214, 0.35);
        box-shadow: 0 0 0 0.2rem rgba(30, 120, 214, 0.10);
        background: #fff;
    }

    .hero-button {
        min-height: 52px;
        padding: 0 22px;
        border: 0;
        border-radius: 16px;
        background: linear-gradient(135deg, #173f70 0%, #1f80df 100%);
        color: #fff;
        font-weight: 700;
        letter-spacing: 0.02em;
        box-shadow: 0 16px 30px rgba(31, 128, 223, 0.22);
    }

    .hero-metrics {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 26px;
    }

    .hero-metric {
        padding: 16px 18px;
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #f6faff 100%);
        border: 1px solid rgba(23, 50, 77, 0.07);
    }

    .hero-metric span {
        display: block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #7290af;
        margin-bottom: 8px;
    }

    .hero-metric strong {
        display: block;
        font-size: 26px;
        font-weight: 800;
        color: var(--dashboard-ink);
        line-height: 1;
    }

    .hero-metric small {
        display: block;
        margin-top: 8px;
        color: var(--dashboard-muted);
        font-size: 13px;
    }

    .focus-panel {
        border-radius: 26px;
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .focus-panel::before {
        content: "";
        position: absolute;
        inset: auto -60px -60px auto;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 174, 0, 0.20) 0%, rgba(255, 174, 0, 0) 72%);
    }

    .focus-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #8a6b16;
        margin-bottom: 10px;
    }

    .focus-number {
        font-size: 48px;
        font-weight: 800;
        color: var(--dashboard-ink);
        line-height: 1;
        margin-bottom: 10px;
    }

    .focus-title {
        font-size: 19px;
        font-weight: 700;
        color: var(--dashboard-ink);
        margin-bottom: 8px;
    }

    .focus-text {
        color: var(--dashboard-muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .focus-list {
        display: grid;
        gap: 12px;
    }

    .focus-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 16px;
        background: rgba(247, 251, 255, 0.9);
        border: 1px solid rgba(23, 50, 77, 0.06);
    }

    .focus-item span {
        color: var(--dashboard-muted);
        font-size: 13px;
        font-weight: 600;
    }

    .focus-item strong {
        color: var(--dashboard-ink);
        font-size: 15px;
        font-weight: 800;
    }

    .section-head {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin: 18px 0 14px;
    }

    .section-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: var(--dashboard-ink);
    }

    .section-text {
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 13px;
    }

    .stats-panel {
        position: relative;
        z-index: 1;
        border-radius: 24px;
        padding: 22px;
    }

    .stat-grid {
        row-gap: 18px;
    }

    .stat-card {
        position: relative;
        height: 100%;
        padding: 18px;
        border-radius: 22px;
        background: #fff;
        border: 1px solid var(--dashboard-line);
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 35px rgba(20, 44, 74, 0.08);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 4px;
        background: var(--accent);
    }

    .stat-card__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #fff;
        background: var(--accent);
        box-shadow: 0 14px 25px rgba(0, 0, 0, 0.10);
    }

    .stat-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 74px;
        min-height: 30px;
        padding: 0 12px;
        border-radius: 999px;
        background: var(--accent-soft);
        color: var(--accent-deep);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .stat-content h6 {
        margin-bottom: 8px;
        font-size: 16px;
        font-weight: 800;
        color: var(--dashboard-ink);
    }

    .stat-number {
        display: block;
        margin-bottom: 6px;
        font-size: 32px;
        line-height: 1;
        font-weight: 800;
        color: var(--dashboard-ink);
    }

    .stat-content p {
        margin: 0;
        color: var(--dashboard-muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .accent-blue {
        --accent: linear-gradient(135deg, #1f6fd1 0%, #3d9cff 100%);
        --accent-soft: rgba(31, 111, 209, 0.10);
        --accent-deep: #1b5db1;
    }

    .accent-mint {
        --accent: linear-gradient(135deg, #0f9f88 0%, #3ed2b9 100%);
        --accent-soft: rgba(15, 159, 136, 0.10);
        --accent-deep: #0e7f6c;
    }

    .accent-gold {
        --accent: linear-gradient(135deg, #d28a10 0%, #f2bf4f 100%);
        --accent-soft: rgba(210, 138, 16, 0.12);
        --accent-deep: #9c670d;
    }

    .accent-rose {
        --accent: linear-gradient(135deg, #cd516b 0%, #f48ca0 100%);
        --accent-soft: rgba(205, 81, 107, 0.12);
        --accent-deep: #a53d55;
    }

    .accent-violet {
        --accent: linear-gradient(135deg, #5d59d9 0%, #8e87ff 100%);
        --accent-soft: rgba(93, 89, 217, 0.10);
        --accent-deep: #4a46b8;
    }

    .accent-sky {
        --accent: linear-gradient(135deg, #118ab2 0%, #53bde3 100%);
        --accent-soft: rgba(17, 138, 178, 0.10);
        --accent-deep: #0f708f;
    }

    @media (max-width: 1199px) {
        .dashboard-hero {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .dashboard-shell {
            padding: 18px;
            border-radius: 22px;
        }

        .hero-panel,
        .focus-panel,
        .stats-panel {
            border-radius: 20px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-metrics {
            grid-template-columns: 1fr;
        }

        .section-head {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    .hero-title .badge {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 10px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="dashboard-shell">
        <div class="dashboard-hero">
            <div class="hero-panel">
                <div>
                    <span class="hero-badge">
                        <i class="bx bx-shield-quarter"></i>
                        Admin Command Center
                    </span>
                    <h1 class="hero-title">Welcome back, <?php echo e(Auth::user()->full_name); ?></h1>

                    <?php if($remainingDays > 0): ?>
                        <span class="badge bg-success ms-2">
                            <?php echo e($remainingDays); ?> days left
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger ms-2">
                            Expired
                        </span>
                    <?php endif; ?>
                </div>

                <div class="hero-metrics">
                    <div class="hero-metric">
                        <span>People</span>
                        <strong><?php echo e($userCount); ?></strong>
                        <small>Active users in your company</small>
                    </div>
                    <div class="hero-metric">
                        <span>Content</span>
                        <strong><?php echo e($sopCount + $checklistCount + $videoCount); ?></strong>
                        <small>Total active learning modules</small>
                    </div>
                </div>
            </div>

            <div class="focus-panel">
                <div class="focus-label">Today at a glance</div>
                <div class="focus-number"><?php echo e($sopQuestionCount + $checklistQuestionCount + $videoQuestionCount); ?></div>
                <div class="focus-title">Total Question Bank</div>
                <p class="focus-text">
                    Your active SOP, checklist, and video modules currently contain this many published question and answer items.
                </p>

                <div class="focus-list">
                    <div class="focus-item">
                        <span>SOP results logged</span>
                        <strong><?php echo e($sopResultTotal); ?></strong>
                    </div>
                    <div class="focus-item">
                        <span>Video results logged</span>
                        <strong><?php echo e($videoResultTotal); ?></strong>
                    </div>
                    <div class="focus-item">
                        <span>Departments running</span>
                        <strong><?php echo e($departmentCount); ?></strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-head">
            <div>
                <h2 class="section-title">Workspace Overview</h2>
                <p class="section-text">Core entities and content volume across your admin workspace.</p>
            </div>
        </div>

        <div class="stats-panel">
            <div class="row stat-grid">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-blue">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-user"></i></div>
                            <span class="stat-chip">Users</span>
                        </div>
                        <div class="stat-content">
                            <h6>User</h6>
                            <strong class="stat-number"><?php echo e($userCount); ?></strong>
                            <p>Currently active user accounts inside your company workspace.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-mint">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-buildings"></i></div>
                            <span class="stat-chip">Teams</span>
                        </div>
                        <div class="stat-content">
                            <h6>Department</h6>
                            <strong class="stat-number"><?php echo e($departmentCount); ?></strong>
                            <p>Departments enabled and available for assignments.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-gold">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-file"></i></div>
                            <span class="stat-chip">Docs</span>
                        </div>
                        <div class="stat-content">
                            <h6>SOP</h6>
                            <strong class="stat-number"><?php echo e($sopCount); ?></strong>
                            <p>Active SOP modules available to your training program.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-rose">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-list-check"></i></div>
                            <span class="stat-chip">Checks</span>
                        </div>
                        <div class="stat-content">
                            <h6>Checklist</h6>
                            <strong class="stat-number"><?php echo e($checklistCount); ?></strong>
                            <p>Active checklist modules being used for step-based reviews.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-violet">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-video"></i></div>
                            <span class="stat-chip">Media</span>
                        </div>
                        <div class="stat-content">
                            <h6>Video</h6>
                            <strong class="stat-number"><?php echo e($videoCount); ?></strong>
                            <p>Video modules published and marked active for your company.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-sky">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-help-circle"></i></div>
                            <span class="stat-chip">SOP Q&amp;A</span>
                        </div>
                        <div class="stat-content">
                            <h6>SOP Q &amp; A</h6>
                            <strong class="stat-number"><?php echo e($sopQuestionCount); ?></strong>
                            <p>Question records attached to active SOP learning modules.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-blue">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-help-circle"></i></div>
                            <span class="stat-chip">Video Q&amp;A</span>
                        </div>
                        <div class="stat-content">
                            <h6>Vedio Q &amp; A</h6>
                            <strong class="stat-number"><?php echo e($videoQuestionCount); ?></strong>
                            <p>Question records linked to active video-based assessments.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-mint">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-help-circle"></i></div>
                            <span class="stat-chip">Checklist Q&amp;A</span>
                        </div>
                        <div class="stat-content">
                            <h6>Check list Q &amp; A</h6>
                            <strong class="stat-number"><?php echo e($checklistQuestionCount); ?></strong>
                            <p>Question records mapped to active checklist modules.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card accent-gold">
                        <div class="stat-card__top">
                            <div class="stat-icon"><i class="bx bx-bar-chart"></i></div>
                            <span class="stat-chip">Results</span>
                        </div>
                        <div class="stat-content">
                            <h6>Result</h6>
                            <strong class="stat-number"><?php echo e($sopResultTotal + $videoResultTotal); ?></strong>
                            <p>Total assessment results collected from SOP and video modules.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_project\skillmatrixl10\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>