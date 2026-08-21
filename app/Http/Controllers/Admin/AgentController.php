<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index() { $items=Agent::latest()->paginate(15); return view('admin.agents.index',compact('items')); }
    public function create() { return view('admin.agents.create'); }
    public function store(Request $request) { Agent::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.agents.index')->with('success','Record created successfully.'); }
    public function show(Agent $item) { return view('admin.agents.show',compact('item')); }
    public function edit(Agent $item) { return view('admin.agents.edit',compact('item')); }
    public function update(Request $request,Agent $item) { $item->update($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.agents.index')->with('success','Record updated successfully.'); }
    public function destroy(Agent $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}