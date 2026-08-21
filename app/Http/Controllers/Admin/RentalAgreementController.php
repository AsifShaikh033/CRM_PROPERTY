<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalAgreement;
use Illuminate\Http\Request;

class RentalAgreementController extends Controller
{
    public function index() { $items=RentalAgreement::latest()->paginate(15); return view('admin.agreements.index',compact('items')); }
    public function create() { return view('admin.agreements.create'); }
    public function store(Request $request) { RentalAgreement::create($request->validate(['property_id'=>'nullable|integer','unit_id'=>'nullable|integer','tenant_id'=>'nullable|integer','start_date'=>'required|date','end_date'=>'required|date','rent'=>'required|numeric|min:0','deposit'=>'required|numeric|min:0','status'=>'required|string|max:50'])); return redirect()->route('admin.agreements.index')->with('success','Record created successfully.'); }
    public function show(RentalAgreement $item) { return view('admin.agreements.show',compact('item')); }
    public function edit(RentalAgreement $item) { return view('admin.agreements.edit',compact('item')); }
    public function update(Request $request,RentalAgreement $item) { $item->update($request->validate(['property_id'=>'nullable|integer','unit_id'=>'nullable|integer','tenant_id'=>'nullable|integer','start_date'=>'required|date','end_date'=>'required|date','rent'=>'required|numeric|min:0','deposit'=>'required|numeric|min:0','status'=>'required|string|max:50'])); return redirect()->route('admin.agreements.index')->with('success','Record updated successfully.'); }
    public function destroy(RentalAgreement $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}