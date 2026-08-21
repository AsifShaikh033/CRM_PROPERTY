<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index() { $items=PropertyType::latest()->paginate(15); return view('admin.property-types.index',compact('items')); }
    public function create() { return view('admin.property-types.create'); }
    public function store(Request $request) { PropertyType::create($request->validate(['name'=>'required|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.property-types.index')->with('success','Record created successfully.'); }
    public function show(PropertyType $item) { return view('admin.property-types.show',compact('item')); }
    public function edit(PropertyType $item) { return view('admin.property-types.edit',compact('item')); }
    public function update(Request $request,PropertyType $item) { $item->update($request->validate(['name'=>'required|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.property-types.index')->with('success','Record updated successfully.'); }
    public function destroy(PropertyType $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}