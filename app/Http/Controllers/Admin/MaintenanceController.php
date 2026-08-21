<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $items = Maintenance::with([
            'property',
            'tenant',
        ])
        ->latest()
        ->paginate(15);

        return view('admin.maintenance.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

      //  $units = collect();

        return view('admin.maintenance.create', compact(
            'properties',
            'tenants',
           // 'units'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
          //  'unit_id' => 'nullable|integer',
            'tenant_id' => 'nullable|exists:tenants,id',

            'title' => 'required|string|max:255',

            'description' => 'nullable|string|max:1000',

            'priority' => 'required|in:low,medium,high,urgent',

            'status' => 'required|in:open,in_progress,completed,cancelled',

            'assigned_to' => 'nullable|string|max:255',

            'completed_at' => 'nullable|date',
        ]);

        Maintenance::create($data);

        return redirect()
            ->route('admin.maintenance.index')
            ->with('success', 'Maintenance request created successfully.');
    }


    public function show(Maintenance $maintenance)
    {
        $maintenance->load([
            'property',
            'tenant',
        ]);

        return view('admin.maintenance.show', [
            'item' => $maintenance
        ]);
    }


    public function edit(Maintenance $maintenance)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

       // $units = collect();

        return view('admin.maintenance.edit', [
            'item' => $maintenance,
            'properties' => $properties,
            'tenants' => $tenants,
            //'units' => $units,
        ]);
    }


    public function update(Request $request, Maintenance $maintenance)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
           // 'unit_id' => 'nullable|integer',
            'tenant_id' => 'nullable|exists:tenants,id',

            'title' => 'required|string|max:255',

            'description' => 'nullable|string|max:1000',

            'priority' => 'required|in:low,medium,high,urgent',

            'status' => 'required|in:open,in_progress,completed,cancelled',

            'assigned_to' => 'nullable|string|max:255',

            'completed_at' => 'nullable|date',
        ]);

        $maintenance->update($data);

        return redirect()
            ->route('admin.maintenance.index')
            ->with('success', 'Maintenance request updated successfully.');
    }


    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()
            ->route('admin.maintenance.index')
            ->with('success', 'Maintenance request deleted successfully.');
    }
}