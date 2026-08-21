<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index() { $items=Owner::latest()->paginate(15); return view('admin.owners.index',compact('items')); }
    public function create() { return view('admin.owners.create'); }
    public function store(Request $request) { Owner::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','address'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.owners.index')->with('success','Record created successfully.'); }
    public function show(Owner $item) { return view('admin.owners.show',compact('item')); }
    public function edit(Owner $item) { return view('admin.owners.edit',compact('item')); }
    public function update(Request $request,Owner $item) { $item->update($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','address'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.owners.index')->with('success','Record updated successfully.'); }
    public function destroy(Owner $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}