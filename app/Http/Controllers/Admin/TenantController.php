<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index() { $items=Tenant::latest()->paginate(15); return view('admin.tenants.index',compact('items')); }
    public function create() { return view('admin.tenants.create'); }
    public function store(Request $request) { Tenant::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','address'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.tenants.index')->with('success','Record created successfully.'); }
    public function show(Tenant $item) { return view('admin.tenants.show',compact('item')); }
    public function edit(Tenant $item) { return view('admin.tenants.edit',compact('item')); }
    public function update(Request $request,Tenant $item) { $item->update($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','address'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.tenants.index')->with('success','Record updated successfully.'); }
    public function destroy(Tenant $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}