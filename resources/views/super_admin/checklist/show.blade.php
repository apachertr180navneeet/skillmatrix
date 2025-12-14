@extends('super_admin.layouts.app')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="text-center">View Checklist</h5>
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
                               value="{{ \Carbon\Carbon::parse($checklist->created_at)->format('d-m-Y') }}"
                               readonly>
                    </div>

                    <!-- Checklist Title -->
                    <div class="col-md-3">
                        <label class="form-label">Checklist Title</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $checklist->title }}"
                               readonly>
                    </div>

                    <!-- Department -->
                    <div class="col-md-3">
                        <label class="form-label">Department</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $checklist->department->department_name ?? '-' }}"
                               readonly>
                    </div>

                    <!-- Company -->
                    <div class="col-md-3">
                        <label class="form-label">Company</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $checklist->company->name ?? '-' }}"
                               readonly>
                    </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" readonly>{{ $checklist->description ?? '-' }}</textarea>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Uploaded File</label>

                        @if($checklist->file)
                            <div class="border p-2 rounded bg-light">
                                <a href="{{ $checklist->file }}"
                                   target="_blank"
                                   class="text-primary">
                                    View Uploaded File
                                </a>
                            </div>
                        @else
                            <p class="text-muted">No file uploaded</p>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="col-md-6 d-flex align-items-end justify-content-end">
                        <a href="{{ route('super.admin.checklist.index') }}"
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
