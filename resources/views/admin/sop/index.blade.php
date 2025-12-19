@extends('admin.layouts.app')

@section('style')
<style>
    .sop-card {
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        text-align: center;
        height: 100%;
    }

    .sop-box {
        height: 110px;
        background: #1e78d6;
        border-radius: 14px;
        margin-bottom: 12px;
    }

    .sop-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .add-qa-btn {
        font-size: 12px;
        padding: 4px 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <!-- ================= SUGGESTED SOP ================= -->
    <h5 class="mb-3">Suggestions SOP</h5>

    <div class="row g-3 mb-5">
        @for ($i = 1; $i <= 4; $i++)
            <div class="col-md-3">
                <div class="sop-card">
                    <div class="sop-box"></div>
                    <div class="sop-title">SOP {{ $i }}</div>
                </div>
            </div>
        @endfor
    </div>

    <!-- ================= CREATED SOP ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Created SOP</h5>

        <select id="departmentFilter" class="form-select w-auto">
            <option value="">Department</option>
        </select>
    </div>

    <div class="row g-3" id="sopContainer">
        <!-- SOP cards will load here -->
    </div>

</div>
@endsection

@section('script')

@endsection
