<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() { $items=Booking::latest()->paginate(15); return view('admin.bookings.index',compact('items')); }
    public function create() { return view('admin.bookings.create'); }
    public function store(Request $request) { Booking::create($request->validate(['property_id'=>'nullable|integer','tenant_id'=>'nullable|integer','booking_date'=>'required|date','amount'=>'required|numeric|min:0','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.bookings.index')->with('success','Record created successfully.'); }
    public function show(Booking $item) { return view('admin.bookings.show',compact('item')); }
    public function edit(Booking $item) { return view('admin.bookings.edit',compact('item')); }
    public function update(Request $request,Booking $item) { $item->update($request->validate(['property_id'=>'nullable|integer','tenant_id'=>'nullable|integer','booking_date'=>'required|date','amount'=>'required|numeric|min:0','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.bookings.index')->with('success','Record updated successfully.'); }
    public function destroy(Booking $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}