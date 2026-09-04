@extends('Admin.layout.main')

@section('title', 'Property Visits')

@section('content')
@php
$badgeClasses = ['Scheduled' => 'bg-primary', 'Completed' => 'bg-success', 'Cancelled' => 'bg-danger', 'Rescheduled' =>
'bg-info', 'No Show' => 'bg-dark', 'Pending' => 'bg-warning text-dark'];
@endphp
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Visits</h3>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title">Property Visits List</div>
                <a href="{{ route('admin.property-visits.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Add Visit</a>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-2 mb-4">
                    <div class="col-md-3"><select name="property_id" class="form-select">
                            <option value="">All Properties</option>@foreach($properties as $property)<option
                                value="{{ $property->id }}" @selected(request('property_id')==$property->
                                id)>{{ $property->name }}</option>@endforeach
                        </select></div>
                    <div class="col-md-2"><select name="lead_id" class="form-select">
                            <option value="">All Leads</option>@foreach($leads as $lead)<option value="{{ $lead->id }}"
                                @selected(request('lead_id')==$lead->id)>{{ $lead->lead_name }}</option>@endforeach
                        </select></div>
                    <div class="col-md-2"><select name="agent_id" class="form-select">
                            <option value="">All Agents</option>@foreach($agents as $agent)<option
                                value="{{ $agent->id }}" @selected(request('agent_id')==$agent->id)>{{ $agent->name }}
                            </option>@endforeach
                        </select></div>
                    <div class="col-md-2"><select name="status" class="form-select">
                            <option value="">All Statuses</option>@foreach($statuses as $status)<option
                                value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-2"><input type="date" name="visit_date" value="{{ request('visit_date') }}"
                            class="form-control"></div>
                    <div class="col-md-1 d-flex gap-1">
                        <button class="btn btn-primary" title="Filter"><i class="fa fa-filter"></i></button>
                        <!-- <a href="{{ route('admin.property-visits.index') }}" class="btn btn-light" title="Clear filters">
                        <i class="fa fa-undo"></i></a> -->
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Property</th>
                                <th>Lead / Customer</th>
                                <th>Agent</th>
                                <th>Visit Date</th>
                                <th>Visit Time</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>@if($item->property)<strong>{{ $item->property->name }}</strong>@if($item->property->property_code)<br><small
                                        class="text-muted">{{ $item->property->property_code }}</small>@endif @else
                                    <span class="text-muted">Unavailable</span> @endif
                                </td>
                                <td>@if($item->lead)<strong>{{ $item->lead->lead_name }}</strong>@if($item->lead->phone)<br><small
                                        class="text-muted">{{ $item->lead->phone }}</small>@endif @else <span
                                        class="text-muted">Unavailable</span> @endif</td>
                                <td>{{ $item->agent?->name ?? '—' }}</td>
                                <td>{{ $item->visit_date?->format('d M Y') ?? '—' }}</td>
                                <td>{{ $item->visit_time ? \Carbon\Carbon::parse($item->visit_time)->format('h:i A') : '—' }}
                                </td>
                                <td><span
                                        class="badge {{ $badgeClasses[$item->status] ?? 'bg-secondary' }}">{{ $item->status }}</span>
                                </td>
                                <td title="{{ $item->visit_notes }}">
                                    {{ \Illuminate\Support\Str::limit($item->visit_notes, 45) ?: '—' }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('admin.property-visits.show', $item) }}"
                                            class="btn btn-link btn-info btn-lg" title="View"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.property-visits.edit', $item) }}"
                                            class="btn btn-link btn-primary btn-lg" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteVisitModal"
                                            data-id="{{ $item->id }}" class="btn btn-link btn-danger" title="Delete"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No property visits found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $items->withQueryString()->links() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteVisitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5><button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this property visit? This action cannot be undone.
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <form id="deleteVisitForm" method="POST">@csrf @method('DELETE')<button
                        class="btn btn-danger">Delete</button></form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('#deleteVisitModal').on('show.bs.modal', function(event) {
    $('#deleteVisitForm').attr('action', "{{ url('admin/property-visits') }}/" + $(event.relatedTarget).data(
        'id'));
});
</script>
@endpush