<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentPayment;
use App\Models\Tenant;
use App\Models\Property;
use Illuminate\Http\Request;

class RentPaymentController extends Controller
{
    public function index()
    {
        $items = RentPayment::with([
                'tenant',
                'property',
                //'unit'
            ])
            ->latest()
            ->paginate(15);

        return view('Admin.rent-payments.index', compact('items'));
    }


    public function create()
    {
        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

       // $units = collect();

        return view('Admin.rent-payments.create', compact(
            'tenants',
            'properties',
           // 'units'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => 'nullable|exists:tenants,id',
            'property_id' => 'nullable|exists:properties,id',
           // 'unit_id' => 'nullable|integer',

            'amount' => 'required|numeric|min:0',

            'payment_date' => 'required|date',

            'month' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',

            'method' => 'nullable|string|max:255',

            'status' => 'required|in:pending,paid,failed,refunded',

            'reference' => 'nullable|string|max:255',
        ]);

        RentPayment::create($data);

        return redirect()
            ->route('admin.rent-payments.index')
            ->with('success', 'Rent payment created successfully.');
    }


    public function show(RentPayment $rentPayment)
    {
        $rentPayment->load([
            'tenant',
            'property',
           // 'unit'
        ]);

        return view('Admin.rent-payments.show', [
            'item' => $rentPayment
        ]);
    }


    public function edit(RentPayment $rentPayment)
    {
        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

       // $units = collect();

        return view('Admin.rent-payments.edit', [
            'item' => $rentPayment,
            'tenants' => $tenants,
            'properties' => $properties,
           // 'units' => $units,
        ]);
    }


    public function update(Request $request, RentPayment $rentPayment)
    {
        $data = $request->validate([
            'tenant_id' => 'nullable|exists:tenants,id',
            'property_id' => 'nullable|exists:properties,id',
           // 'unit_id' => 'nullable|integer',

            'amount' => 'required|numeric|min:0',

            'payment_date' => 'required|date',

            'month' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',

            'method' => 'nullable|string|max:255',

            'status' => 'required|in:pending,paid,failed,refunded',

            'reference' => 'nullable|string|max:255',
        ]);

        $rentPayment->update($data);

        return redirect()
            ->route('admin.rent-payments.index')
            ->with('success', 'Rent payment updated successfully.');
    }


    public function destroy(RentPayment $rentPayment)
    {
        $rentPayment->delete();

        return redirect()
            ->route('admin.rent-payments.index')
            ->with('success', 'Rent payment deleted successfully.');
    }
}