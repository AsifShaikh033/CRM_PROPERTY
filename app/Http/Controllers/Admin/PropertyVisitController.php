<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyVisit;
use App\Models\Property;
use App\Models\Lead;
use Illuminate\Http\Request;

class PropertyVisitController extends Controller
{
    public function index()
    {
        $items = PropertyVisit::with(['property', 'lead'])
            ->latest()
            ->paginate(15);

        return view('Admin.visits.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $leads = Lead::latest()
            ->orderBy('name')
            ->get();

        return view('Admin.visits.create', compact(
            'properties',
            'leads'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'lead_id' => 'nullable|exists:leads,id',
            'visit_date' => 'required|date',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        PropertyVisit::create($data);

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Property visit created successfully.');
    }


    public function show(PropertyVisit $visit)
    {
        $visit->load(['property', 'lead']);

        return view('Admin.visits.show', [
            'item' => $visit
        ]);
    }


    public function edit(PropertyVisit $visit)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $leads = Lead::latest()
            ->orderBy('name')
            ->get();

        return view('Admin.visits.edit', [
            'item' => $visit,
            'properties' => $properties,
            'leads' => $leads,
        ]);
    }


    public function update(Request $request, PropertyVisit $visit)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'lead_id' => 'nullable|exists:leads,id',
            'visit_date' => 'required|date',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $visit->update($data);

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Property visit updated successfully.');
    }


    public function destroy(PropertyVisit $visit)
    {
        $visit->delete();

        return redirect()
            ->route('admin.visits.index')
            ->with('success', 'Property visit deleted successfully.');
    }
}