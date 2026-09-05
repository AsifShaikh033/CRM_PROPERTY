<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyVisit;
use App\Models\Property;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\NotificationHelper;

class PropertyVisitController extends Controller
{
    private const STATUSES = ['Scheduled', 'Completed', 'Cancelled', 'Rescheduled', 'No Show', 'Pending'];
    private const CUSTOMER_STATUSES = ['Interested', 'Not Interested', 'Pending'];

    public function index(Request $request)
    {
        $items = PropertyVisit::with(['property', 'lead', 'agent'])
            ->when($request->filled('property_id'), fn ($query) => $query->where('property_id', $request->integer('property_id')))
            ->when($request->filled('lead_id'), fn ($query) => $query->where('lead_id', $request->integer('lead_id')))
            ->when($request->filled('agent_id'), fn ($query) => $query->where('agent_id', $request->integer('agent_id')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->when($request->filled('customer_status'), fn ($query) => $query->where('customer_status', $request->input('customer_status')))
            ->when($request->filled('visit_date'), fn ($query) => $query->whereDate('visit_date', $request->input('visit_date')))
            ->latest()
            ->paginate(15);

        return view('Admin.property-visits.index', [
            'items' => $items,
            'properties' => Property::orderBy('name')->get(['id', 'name', 'property_code']),
            'leads' => Lead::orderBy('lead_name')->get(['id', 'lead_name', 'phone']),
            'agents' => $this->agents()->get(['id', 'name', 'mob_number']),
            'statuses' => self::STATUSES,
            'customerStatuses' => self::CUSTOMER_STATUSES,
        ]);
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $leads = Lead::orderBy('lead_name')
            ->get();

        $agents = $this->agents()->get();

        return view('Admin.property-visits.create', compact(
            'properties',
            'leads',
            'agents'
        ));
    }


    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        PropertyVisit::create($data);
        $propertyVisit = PropertyVisit::latest()->first();
        NotificationHelper::create(
            'New Property Visit',
            'property_visit_add',
            'A new visit has been scheduled for property "' .
                $propertyVisit->property->name .
                '".'
        );

        return redirect()
            ->route('admin.property-visits.index')
            ->with('success', 'Property visit created successfully.');
    }


    public function show(PropertyVisit $visit)
    {
        $visit->load(['property', 'lead', 'agent']);

        return view('Admin.property-visits.show', [
            'item' => $visit
        ]);
    }


    public function edit(PropertyVisit $visit)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $leads = Lead::orderBy('lead_name')
            ->get();

        $agents = $this->agents()
            ->orWhere('users.id', $visit->agent_id)
            ->get();

        return view('Admin.property-visits.edit', [
            'item' => $visit,
            'properties' => $properties,
            'leads' => $leads,
            'agents' => $agents,
        ]);
    }


    public function update(Request $request, PropertyVisit $visit)
    {
        $data = $this->validatedData($request);

        $visit->update($data);
        NotificationHelper::create(
            'Property Visit Updated',
            'property_visit_edit',
            'A property visit has been updated.'
        );

        return redirect()
            ->route('admin.property-visits.index')
            ->with('success', 'Property visit updated successfully.');
    }


    public function destroy(PropertyVisit $visit)
    {
        $visit->delete();

        return redirect()
            ->route('admin.property-visits.index')
            ->with('success', 'Property visit deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'property_id' => ['required', Rule::exists('properties', 'id')],
            'lead_id' => ['required', Rule::exists('leads', 'id')],
            'agent_id' => ['nullable', Rule::exists('users', 'id')],
            'visit_date' => ['required', 'date'],
            'visit_time' => ['required', 'date_format:H:i'],
            'status' => ['required', Rule::in(self::STATUSES)],
            'customer_status' => ['required', Rule::in(self::CUSTOMER_STATUSES)],
            'visit_notes' => ['nullable', 'string'],
        ]);
    }

    private function agents()
    {
        return User::whereHas('roles', fn ($query) => $query
            ->where('name', 'Agent')
            ->where('guard_name', 'web'))
            ->orderBy('name');
    }
}
