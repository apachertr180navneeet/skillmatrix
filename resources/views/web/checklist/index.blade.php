@extends('web.userlayouts.app')

@section('style')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .sop-card {
        background: #fff;
        border-radius: 14px;
        padding: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        height: 100%;
        transition: transform 0.2s ease;
    }

    .sop-card:hover {
        transform: translateY(-3px);
    }

    .sop-preview {
        height: 130px;
        background: #2578c9;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .sop-footer {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sop-title {
        font-size: 13px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        word-break: break-word;
    }
</style>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="page-header">
        <h5>Checklist</h5>
        <div>
            <button class="btn btn-primary me-2">Sort</button>
            <button class="btn btn-primary">View</button>
        </div>
    </div>

    <!-- CHECKLIST LIST -->
    <div class="row g-4">

        @forelse ($checklists as $checklist)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

                <div class="sop-card">

                    <!-- Preview -->
                    <div class="sop-preview"></div>

                    <!-- Footer -->
                    <div class="sop-footer">
                        <p class="sop-title">
                            {{ $checklist->title ?? 'Checklist' }}
                        </p>
                    </div>

                </div>

            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No checklists found for your department.
                </div>
            </div>
        @endforelse

    </div>

</div>

@endsection
