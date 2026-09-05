<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use App\Models\PropertyVisit;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Helpers\NotificationHelper;

class BookingController extends Controller
{
    public function index()
    {
        $items = Booking::with(['property', 'lead'])
            ->latest()
            ->paginate(15);

        return view('Admin.bookings.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        // $tenants = Tenant::where('status', 'active')
        //     ->orderBy('name')
        //     ->get();
        $tenants = User::where('role', 2)
        ->orderBy('name')
        ->get();
        $leads = PropertyVisit::with('lead')->where('status', 'Completed')->where('customer_status', 'Interested')->get();


        return view('Admin.bookings.create', compact(
            'properties',
            'tenants',
            'leads'
        ));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'lead_id' => 'nullable|exists:leads,id',
            'booking_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);
        if($request->filled('lead_id')){
            $lead = Lead::find($request->input('lead_id'));
            if ($lead) {
                $data['lead_name'] = $lead->lead_name;
                $data['lead_interested_property'] = $lead->interested_property;
                $data['lead_assigned_agent'] = $lead->assigned_agent;
                $data['lead_phone'] = $lead->phone;
                $data['lead_email'] = $lead->email;
                $data['lead_lead_status'] = $lead->lead_status;
                $data['lead_follow_up_status'] = $lead->follow_up_status;
            }
        }

        Booking::create($data);
        
        $booking = Booking::latest()->first();
        NotificationHelper::create(
            'New Booking Added',
            'booking_add',
            'A new booking has been created for property "' .
                $booking->property->name .
                '".'
        );

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }


    public function show(Booking $booking)
    {
        $booking->load(['property', 'lead']);

        return view('Admin.bookings.show', [
            'item' => $booking
        ]);
    }


    public function edit(Booking $booking)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        // $tenants = Tenant::where('status', 'active')
        //     ->orderBy('name')
        //     ->get();
        $tenants = User::where('role', 2)
        ->orderBy('name')
        ->get();
        $leads = PropertyVisit::with('lead')->where('status', 'Completed')->where('customer_status', 'Interested')->get();

        return view('Admin.bookings.edit', [
            'item' => $booking,
            'properties' => $properties,
            'tenants' => $tenants,
            'leads' => $leads,
        ]);
    }


    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'lead_id' => 'nullable|exists:property_visits,id',
            'booking_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

                if($request->filled('lead_id')){
            $lead = Lead::find($request->input('lead_id'));
            if ($lead) {
                $data['lead_name'] = $lead->lead_name;
                $data['lead_interested_property'] = $lead->interested_property;
                $data['lead_assigned_agent'] = $lead->assigned_agent;
                $data['lead_phone'] = $lead->phone;
                $data['lead_email'] = $lead->email;
                $data['lead_lead_status'] = $lead->lead_status;
                $data['lead_follow_up_status'] = $lead->follow_up_status;
            }
        }

        $booking->update($data);

        NotificationHelper::create(
            'Booking Updated',
            'booking_edit',
            'Booking has been updated successfully.'
        );

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