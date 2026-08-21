<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index() { $items=Vendor::latest()->paginate(15); return view('admin.vendors.index',compact('items')); }
    public function create() { return view('admin.vendors.create'); }
    public function store(Request $request) { Vendor::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','company'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.vendors.index')->with('success','Record created successfully.'); }
    public function show(Vendor $item) { return view('admin.vendors.show',compact('item')); }
    public function edit(Vendor $item) { return view('admin.vendors.edit',compact('item')); }
    public function update(Request $request,Vendor $item) { $item->update($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','company'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.vendors.index')->with('success','Record updated successfully.'); }
    public function destroy(Vendor $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}