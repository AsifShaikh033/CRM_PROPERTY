<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalAgreement;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RentalAgreementController extends Controller
{
    public function index()
    {
        $items = RentalAgreement::with([
                'property',
                'tenant',
                //'unit'
            ])
            ->latest()
            ->paginate(15);

        return view('Admin.agreements.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        /*
         * If you have a Unit model, load units here.
         *
         * $units = Unit::orderBy('unit_number')->get();
         */

        $units = collect();

        return view('Admin.agreements.create', compact(
            'properties',
            'tenants',
            'units'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
           // 'unit_id' => 'nullable|integer',
            'tenant_id' => 'nullable|exists:tenants,id',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'rent' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',

            'status' => 'required|in:draft,active,expired,terminated',
        ]);

        RentalAgreement::create($data);

        return redirect()
            ->route('admin.agreements.index')
            ->with('success', 'Rental agreement created successfully.');
    }


    public function show(RentalAgreement $agreement)
    {
        $agreement->load([
            'property',
            'tenant',
           // 'unit'
        ]);

        return view('Admin.agreements.show', [
            'item' => $agreement
        ]);
    }


    public function edit(RentalAgreement $agreement)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        $units = collect();

        return view('Admin.agreements.edit', [
            'item' => $agreement,
            'properties' => $properties,
            'tenants' => $tenants,
            //'units' => $units,
        ]);
    }


    public function update(Request $request, RentalAgreement $agreement)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
          //  'unit_id' => 'nullable|integer',
            'tenant_id' => 'nullable|exists:tenants,id',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'rent' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',

            'status' => 'required|in:draft,active,expired,terminated',
        ]);

        $agreement->update($data);

        return redirect()
            ->route('admin.agreements.index')
            ->with('success', 'Rental agreement updated successfully.');
    }


    public function destroy(RentalAgreement $agreement)
    {
        $agreement->delete();

        return redirect()
            ->route('admin.agreements.index')
            ->with('success', 'Rental agreement deleted successfully.');
    }
}