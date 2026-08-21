<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $items = Booking::with(['property', 'tenant'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.bookings.create', compact(
            'properties',
            'tenants'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'booking_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        Booking::create($data);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }


    public function show(Booking $booking)
    {
        $booking->load(['property', 'tenant']);

        return view('admin.bookings.show', [
            'item' => $booking
        ]);
    }


    public function edit(Booking $booking)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        $tenants = Tenant::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.bookings.edit', [
            'item' => $booking,
            'properties' => $properties,
            'tenants' => $tenants,
        ]);
    }


    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'booking_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $booking->update($data);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}