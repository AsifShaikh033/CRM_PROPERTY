<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Property;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $items = Lead::latest()->paginate(15);

        return view('admin.leads.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
        ->orderBy('name')
        ->get();
        return view('admin.leads.create', compact('properties'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'property_id' => 'nullable|integer',
            'source' => 'nullable|string|max:255',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
            'notes' => 'nullable|string',
        ]);

        Lead::create($data);

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead created successfully.');
    }


    public function show(Lead $lead)
    {
        return view('admin.leads.show', [
            'item' => $lead
        ]);
    }


    public function edit(Lead $lead)
    {
        $properties = Property::where('status', 'active')
        ->orderBy('name')
        ->get();
        return view('admin.leads.edit', [
            'item' => $lead,
            'properties' => $properties
        ]);
    }


    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'property_id' => 'nullable|integer',
            'source' => 'nullable|string|max:255',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
            'notes' => 'nullable|string',
        ]);

        $lead->update($data);

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead updated successfully.');
    }


    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}