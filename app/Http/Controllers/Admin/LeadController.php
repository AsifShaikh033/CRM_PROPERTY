<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadFollowUp;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\NotificationHelper;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $items = Lead::with(['property', 'assignedAgent'])
            ->when($request->search, function ($query, $value) {
                $query->where(function ($query) use ($value) {
                    $query->where('lead_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                        ->orWhere('lead_source', 'like', "%{$value}%")
                        ->orWhere('lead_status', 'like', "%{$value}%")
                        ->orWhere('follow_up_status', 'like', "%{$value}%")
                        ->orWhereHas('property', fn ($query) => $query->where('name', 'like', "%{$value}%"))
                        ->orWhereHas('assignedAgent', fn ($query) => $query->where('name', 'like', "%{$value}%"));
                });
            })
            ->latest()->get();

        return view('Admin.leads.index', compact('items'));
    }


    public function create()
    {
        return view('Admin.leads.create', $this->formData());
    }


    public function store(Request $request)
    {
        Lead::create($this->leadRules($request));
            NotificationHelper::create(
                'New Lead Added',
                'lead_add',
                'A new lead "' . $request->lead_name . '" has been added.'
            );
        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead created successfully.');
    }


    public function show(Lead $lead)
    {
        $lead->load(['property', 'assignedAgent', 'followUps.agentUser']);
        return view('Admin.leads.show', compact('lead'));
    }


    public function edit(Lead $lead)
    {
        return view('Admin.leads.edit', array_merge(['lead' => $lead], $this->formData()));
    }


    public function update(Request $request, Lead $lead)
    {
        $lead->update($this->leadRules($request));
        NotificationHelper::create(
            'Lead Updated',
            'lead_edit',
            'Lead "' . $lead->lead_name . '" has been updated.'
        );

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead updated successfully.');
    }


    public function destroy(Lead $lead)
    {
        $lead->followUps()->delete();
        $lead->delete();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }

    public function createFollowUp(Lead $lead)
    {
        $lead->load(['property', 'assignedAgent']);
        return view('Admin.leads.create-follow-up', ['lead' => $lead, 'agents' => $this->agents()]);
    }

    public function storeFollowUp(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'agent' => 'required|exists:users,id',
            'contact_date' => 'required|date',
            'contact_method' => 'required|in:Phone Call,WhatsApp,SMS,Email,Meeting,Other',
            'outcome' => 'required|string|max:255',
            'next_action' => 'nullable|string|max:255',
            'next_follow_up_date' => 'nullable|date',
            'reminder' => 'nullable|string|max:255',
            'call_notes' => 'nullable|string',
        ]);

        $lead->followUps()->create($data);
        $lead->update([
            'lead_status' => $data['outcome'],
            'next_follow_up_date' => $data['next_follow_up_date'],
            'reminder' => $data['reminder'],
            'call_notes' => $data['call_notes'],
            'follow_up_status' => $data['next_follow_up_date'] ? 'Pending' : 'Completed',
        ]);

        return redirect()->route('admin.leads.show', $lead)->with('success', 'Follow-up added successfully.');
    }

    private function leadRules(Request $request): array
    {
        return $request->validate([
            'lead_name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\\-\\s]{7,30}$/'],
            'email' => 'nullable|email|max:255',
            'interested_property' => 'nullable|exists:properties,id',
            'assigned_agent' => 'nullable|exists:users,id',
            'lead_source' => 'nullable|string|max:100',
            'lead_status' => 'required|string|max:100',
            'next_follow_up_date' => 'nullable|date',
            'reminder' => 'nullable|string|max:255',
            'call_notes' => 'nullable|string',
            'follow_up_status' => 'required|in:Pending,Completed,Not Required',
            'general_notes' => 'nullable|string',
        ]);
    }

    private function formData(): array
    {
        return [
            'properties' => Property::where('status', 'active')->orderBy('name')->get(),
            'agents' => $this->agents(),
        ];
    }

    private function agents()
    {
        return User::whereHas('roles', fn ($query) => $query->where('name', 'Agent')->where('guard_name', 'web'))
            ->orderBy('name')->get();
    }
}
