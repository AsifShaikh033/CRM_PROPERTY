@extends('Admin.layout.main')

@section('title', 'Lead Details')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header d-flex justify-content-between">
            <h3 class="fw-bold mb-3">Lead Details</h3>
            <div>
                <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-primary">Edit Lead</a>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-light">Back to Lead List</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Lead Name:</strong> {{ $lead->lead_name }}</p>
                        <p><strong>Phone:</strong> {{ $lead->phone }}</p>
                        <p><strong>Email:</strong> {{ $lead->email ?? '-' }}</p>
                        <p><strong>Interested Property:</strong> {{ $lead->property?->name ?? '-' }}</p>
                        <p><strong>Assigned Agent:</strong> {{ $lead->assignedAgent?->name ?? '-' }}</p>
                        <p><strong>Lead Source:</strong> {{ $lead->lead_source ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Lead Status:</strong> {{ $lead->lead_status }}</p>
                        <p><strong>Next Follow-up:</strong> {{ $lead->next_follow_up_date?->format('d M Y') ?? '-' }}</p>
                        <p><strong>Reminder:</strong> {{ $lead->reminder ?? '-' }}</p>
                        <p><strong>Follow-up Status:</strong> {{ $lead->follow_up_status }}</p>
                        <p><strong>Call Notes:</strong> {{ $lead->call_notes ?? '-' }}</p>
                        <p><strong>General Notes:</strong> {{ $lead->general_notes ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Follow-up History</div>
                <a href="{{ route('admin.leads.follow-ups.create', $lead) }}" class="btn btn-success">+ Add Follow-up</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Contact Date</th>
                                <th>Method</th>
                                <th>Outcome</th>
                                <th>Next Action</th>
                                <th>Next Follow-up</th>
                                <th>Agent</th>
                                <th>Reminder</th>
                                <th>Call Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lead->followUps->sortByDesc('contact_date') as $followUp)
                                <tr>
                                    <td>{{ $followUp->contact_date?->format('d M Y') }}</td>
                                    <td>{{ $followUp->contact_method }}</td>
                                    <td>{{ $followUp->outcome }}</td>
                                    <td>{{ $followUp->next_action ?? '-' }}</td>
                                    <td>{{ $followUp->next_follow_up_date?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $followUp->agentUser?->name ?? '-' }}</td>
                                    <td>{{ $followUp->reminder ?? '-' }}</td>
                                    <td>{{ $followUp->call_notes ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No follow-ups have been recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
