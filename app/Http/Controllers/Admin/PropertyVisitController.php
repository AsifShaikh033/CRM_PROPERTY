<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyVisit;
use Illuminate\Http\Request;

class PropertyVisitController extends Controller
{
    public function index() { $items=PropertyVisit::latest()->paginate(15); return view('admin.visits.index',compact('items')); }
    public function create() { return view('admin.visits.create'); }
    public function store(Request $request) { PropertyVisit::create($request->validate(['property_id'=>'nullable|integer','lead_id'=>'nullable|integer','visit_date'=>'required|date','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.visits.index')->with('success','Record created successfully.'); }
    public function show(PropertyVisit $item) { return view('admin.visits.show',compact('item')); }
    public function edit(PropertyVisit $item) { return view('admin.visits.edit',compact('item')); }
    public function update(Request $request,PropertyVisit $item) { $item->update($request->validate(['property_id'=>'nullable|integer','lead_id'=>'nullable|integer','visit_date'=>'required|date','status'=>'required|string|max:50','notes'=>'nullable|string|max:255'])); return redirect()->route('admin.visits.index')->with('success','Record updated successfully.'); }
    public function destroy(PropertyVisit $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}