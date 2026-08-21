<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index() { $items=Lead::latest()->paginate(15); return view('admin.leads.index',compact('items')); }
    public function create() { return view('admin.leads.create'); }
    public function store(Request $request) { Lead::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','property_id'=>'nullable|integer','source'=>'nullable|string|max:255','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.leads.index')->with('success','Record created successfully.'); }
    public function show(Lead $item) { return view('admin.leads.show',compact('item')); }
    public function edit(Lead $item) { return view('admin.leads.edit',compact('item')); }
    public function update(Request $request,Lead $item) { $item->update($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','property_id'=>'nullable|integer','source'=>'nullable|string|max:255','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.leads.index')->with('success','Record updated successfully.'); }
    public function destroy(Lead $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}