<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentPayment;
use Illuminate\Http\Request;

class RentPaymentController extends Controller
{
    public function index() { $items=RentPayment::latest()->paginate(15); return view('admin.rent-payments.index',compact('items')); }
    public function create() { return view('admin.rent-payments.create'); }
    public function store(Request $request) { RentPayment::create($request->validate(['tenant_id'=>'nullable|integer','property_id'=>'nullable|integer','unit_id'=>'nullable|integer','amount'=>'required|numeric|min:0','payment_date'=>'required|date','month'=>'nullable|string|max:255','year'=>'nullable|string|max:255','method'=>'nullable|string|max:255','status'=>'required|string|max:50','reference'=>'nullable|string|max:255'])); return redirect()->route('admin.rent-payments.index')->with('success','Record created successfully.'); }
    public function show(RentPayment $item) { return view('admin.rent-payments.show',compact('item')); }
    public function edit(RentPayment $item) { return view('admin.rent-payments.edit',compact('item')); }
    public function update(Request $request,RentPayment $item) { $item->update($request->validate(['tenant_id'=>'nullable|integer','property_id'=>'nullable|integer','unit_id'=>'nullable|integer','amount'=>'required|numeric|min:0','payment_date'=>'required|date','month'=>'nullable|string|max:255','year'=>'nullable|string|max:255','method'=>'nullable|string|max:255','status'=>'required|string|max:50','reference'=>'nullable|string|max:255'])); return redirect()->route('admin.rent-payments.index')->with('success','Record updated successfully.'); }
    public function destroy(RentPayment $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}