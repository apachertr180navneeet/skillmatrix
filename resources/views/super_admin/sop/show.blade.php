@extends('super_admin.layouts.app')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="text-center">View SOP</h5>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form>

                <div class="row mb-3">
                    <!-- Date -->
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $sop->created_at->format('d-m-Y') }}"
                               readonly>
                    </div>

                    <!-- SOP Title -->
                    <div class="col-md-3">
                        <label class="form-label">SOP Title</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $sop->title }}"
                               readonly>
                    </div>

                    <!-- Department -->
                    <div class="col-md-3">
                        <label class="form-label">Department</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $sop->department->department_name ?? '-' }}"
                               readonly>
                    </div>

                    <!-- Party / Company -->
                    <div class="col-md-3">
                        <label class="form-label">Party Name</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $sop->company->name ?? '-' }}"
                               readonly>
                    </div>
                </div>

                <!-- SOP Upload -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">SOP Upload</label>

                        @if($sop->sop_upload)
                            <div class="border p-2 rounded bg-light">
                                <div class="mt-1">
                                    <a href="{{ route('super.admin.sop.view', Crypt::encryptString($sop->id)) }}"
                                    target="_blank"
                                    class="text-primary">
                                        Uploaded sop - view
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No SOP uploaded</p>
                        @endif
                    </div>

                    <!-- Button -->
                    <div class="col-md-6 d-flex align-items-end justify-content-end">
                        <a href="{{ route('super.admin.sop.index') }}"
                           class="btn btn-primary">
                            Back
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
