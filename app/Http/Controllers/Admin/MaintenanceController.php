<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index() { $items=Maintenance::latest()->paginate(15); return view('admin.maintenance.index',compact('items')); }
    public function create() { return view('admin.maintenance.create'); }
    public function store(Request $request) { Maintenance::create($request->validate(['property_id'=>'nullable|integer','unit_id'=>'nullable|integer','tenant_id'=>'nullable|integer','title'=>'required|string|max:255','description'=>'nullable|string|max:255','priority'=>'nullable|string|max:255','status'=>'required|string|max:50','assigned_to'=>'nullable|string|max:255','completed_at'=>'nullable|string|max:255'])); return redirect()->route('admin.maintenance.index')->with('success','Record created successfully.'); }
    public function show(Maintenance $item) { return view('admin.maintenance.show',compact('item')); }
    public function edit(Maintenance $item) { return view('admin.maintenance.edit',compact('item')); }
    public function update(Request $request,Maintenance $item) { $item->update($request->validate(['property_id'=>'nullable|integer','unit_id'=>'nullable|integer','tenant_id'=>'nullable|integer','title'=>'required|string|max:255','description'=>'nullable|string|max:255','priority'=>'nullable|string|max:255','status'=>'required|string|max:50','assigned_to'=>'nullable|string|max:255','completed_at'=>'nullable|string|max:255'])); return redirect()->route('admin.maintenance.index')->with('success','Record updated successfully.'); }
    public function destroy(Maintenance $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}