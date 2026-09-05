@extends('Admin.layout.main') @section('title', 'Property Visit Details') @section('content') @php $badgeClasses = ['Scheduled' => 'bg-primary', 'Completed' => 'bg-success', 'Cancelled' => 'bg-danger', 'Rescheduled' => 'bg-info', 'No Show' => 'bg-dark',
'Pending' => 'bg-warning text-dark']; @endphp
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Visit Details</h3></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title">Visit #{{ $item->id }}</div><span class="badge {{ $badgeClasses[$item->status] ?? 'bg-secondary' }}">{{ $item->status }}</span></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Property</label>
                                    <div class="form-control bg-light">{{ $item->property?->name ?? 'Unavailable' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lead / Customer</label>
                                    <div class="form-control bg-light">{{ $item->lead?->lead_name ?? 'Unavailable' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent</label>
                                    <div class="form-control bg-light">{{ $item->agent?->name ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Visit Date</label>
                                    <div class="form-control bg-light">{{ $item->visit_date?->format('d M Y') ?? '—' }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Visit Time</label>
                                    <div class="form-control bg-light">{{ $item->visit_time ? \Carbon\Carbon::parse($item->visit_time)->format('h:i A') : '—' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-control bg-light">{{ $item->status }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Status</label>
                                    <div class="form-control bg-light">{{ $item->customer_status }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Visit Notes</label>
                                    <div class="form-control bg-light" style="min-height: 120px; height: auto; white-space: pre-wrap;">{{ $item->visit_notes ?: 'No notes available.' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action"><a href="{{ route('admin.property-visits.index') }}" class="btn btn-light">Back</a><a href="{{ route('admin.property-visits.edit', $item) }}" class="btn btn-primary ms-2"><i class="fa fa-edit"></i> Edit</a>
                            <button type="button"
                            data-bs-toggle="modal" data-bs-target="#deleteVisitModal" class="btn btn-danger ms-2"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="card-title">Record Information</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Created At</label>
                            <div class="form-control bg-light">{{ $item->created_at?->format('d M Y, h:i A') ?? '—' }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Updated At</label>
                            <div class="form-control bg-light">{{ $item->updated_at?->format('d M Y, h:i A') ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <div class="card-title">Lead Details</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Lead Name</label>
                            <div class="form-control bg-light">{{ $item->lead->lead_name ?? '—' }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Phone</label>
                            <div class="form-control bg-light">{{ $item->lead->phone ?? '—' }}</div>
                        </div>
                         <div class="form-group mb-0">
                            <label>Email</label>
                            <div class="form-control bg-light">{{ $item->lead->email ?? '—' }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Interested Property</label>
                            <div class="form-control bg-light">{{ $item->lead->property?->name ?? '—' }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Status</label>
                            <div class="form-control bg-light">{{ $item->lead->lead_status ?? '—' }}</div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Assigned Agent</label>
                            <div class="form-control bg-light">{{ $item->lead->assignedAgent?->name ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteVisitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this property visit? This action cannot be undone.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('admin.property-visits.destroy', $item) }}">@csrf @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection