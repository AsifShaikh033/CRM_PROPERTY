@extends('Admin.layout.main') @section('title', 'Leads') @section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header d-flex justify-content-between">
            <h3 class="fw-bold mb-3">Leads</h3>@can('leads.create')<a href="{{ route('admin.leads.create') }}" class="btn btn-primary">+ Add Lead</a>@endcan</div>
        <div class="card">
            <div class="card-body">
                <form method="GET" class="row g-2 mb-3">
                    <div class="col-md-6">
                        <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, phone, email, property, agent, source or status">
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-primary">Search</button> <a href="{{ route('admin.leads.index') }}" class="btn btn-light">Reset</a></div>
                </form>
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Lead</th>
                                <th>Property</th>
                                <th>Agent</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>Next Follow-up</th>
                                <th>Follow-up</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>@forelse($items as $lead)
                            <tr>
                                <td><a href="{{ route('admin.leads.show', $lead) }}"><strong>{{ $lead->lead_name }}</strong></a>
                                    <br><small>{{ $lead->phone }}<br>{{ $lead->email }}</small></td>
                                <td>{{ $lead->property?->name ?? '-' }}</td>
                                <td>{{ $lead->assignedAgent?->name ?? '-' }}</td>
                                <td>{{ $lead->lead_source ?? '-' }}</td>
                                <td>{{ $lead->lead_status }}</td>
                                <td>{{ $lead->next_follow_up_date?->format('d M Y') ?? '-' }}</td>
                                <td>{{ $lead->follow_up_status }}</td>
                                <td>{{ $lead->created_at->format('d M Y') }}</td>
                                <td><a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-link btn-primary"><i class="fa fa-eye"></i></a><a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                    <form
                                    method="POST" action="{{ route('admin.leads.destroy', $lead) }}" class="d-inline" onsubmit="return confirm('Delete this lead and all its follow-up history?')">@csrf @method('DELETE')
                                        <button class="btn btn-link btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                </td>
                            </tr>@empty
                            <tr>
                                <td colspan="9" class="text-center">No leads found.</td>
                            </tr>@endforelse</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection