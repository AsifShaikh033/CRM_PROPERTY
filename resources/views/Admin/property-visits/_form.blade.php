@php
    $visit = $item ?? null;
    $statuses = ['Scheduled', 'Completed', 'Cancelled', 'Rescheduled', 'No Show', 'Pending'];
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="property_id">Property <span class="text-danger">*</span></label>
            <select id="property_id" name="property_id" required class="form-select @error('property_id') is-invalid @enderror">
                <option value="">-- Select Property --</option>
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}" @selected(old('property_id', $visit?->property_id) == $property->id)>
                        {{ $property->name }}@if($property->property_code) ({{ $property->property_code }}) @endif
                    </option>
                @endforeach
            </select>
            @error('property_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lead_id">Lead / Customer <span class="text-danger">*</span></label>
            <select id="lead_id" name="lead_id" required class="form-select @error('lead_id') is-invalid @enderror">
                <option value="">-- Select Lead / Customer --</option>
                @foreach ($leads as $lead)
                    <option value="{{ $lead->id }}" @selected(old('lead_id', $visit?->lead_id) == $lead->id)>
                        {{ $lead->lead_name }}@if($lead->phone) - {{ $lead->phone }} @endif
                    </option>
                @endforeach
            </select>
            @error('lead_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="agent_id">Agent</label>
            <select id="agent_id" name="agent_id" class="form-select @error('agent_id') is-invalid @enderror">
                <option value="">-- Select Agent --</option>
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}" @selected(old('agent_id', $visit?->agent_id) == $agent->id)>
                        {{ $agent->name }}@if($agent->mob_number) - {{ $agent->mob_number }} @endif
                    </option>
                @endforeach
            </select>
            @error('agent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="visit_date">Visit Date <span class="text-danger">*</span></label>
            <input id="visit_date" type="date" name="visit_date" required value="{{ old('visit_date', $visit?->visit_date?->format('Y-m-d')) }}" class="form-control @error('visit_date') is-invalid @enderror">
            @error('visit_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="visit_time">Visit Time <span class="text-danger">*</span></label>
            <input id="visit_time" type="time" name="visit_time" required value="{{ old('visit_time', $visit?->visit_time ? \Carbon\Carbon::parse($visit->visit_time)->format('H:i') : '') }}" class="form-control @error('visit_time') is-invalid @enderror">
            @error('visit_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select id="status" name="status" required class="form-select @error('status') is-invalid @enderror">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', $visit?->status ?? 'Scheduled') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="visit_notes">Visit Notes</label>
            <textarea id="visit_notes" name="visit_notes" rows="5" class="form-control @error('visit_notes') is-invalid @enderror" placeholder="Add visit notes">{{ old('visit_notes', $visit?->visit_notes) }}</textarea>
            @error('visit_notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
