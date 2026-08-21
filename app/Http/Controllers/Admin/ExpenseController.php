<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index() { $items=Expense::latest()->paginate(15); return view('admin.expenses.index',compact('items')); }
    public function create() { return view('admin.expenses.create'); }
    public function store(Request $request) { Expense::create($request->validate(['property_id'=>'nullable|integer','title'=>'required|string|max:255','amount'=>'required|numeric|min:0','expense_date'=>'required|date','status'=>'required|string|max:50','description'=>'nullable|string|max:255'])); return redirect()->route('admin.expenses.index')->with('success','Record created successfully.'); }
    public function show(Expense $item) { return view('admin.expenses.show',compact('item')); }
    public function edit(Expense $item) { return view('admin.expenses.edit',compact('item')); }
    public function update(Request $request,Expense $item) { $item->update($request->validate(['property_id'=>'nullable|integer','title'=>'required|string|max:255','amount'=>'required|numeric|min:0','expense_date'=>'required|date','status'=>'required|string|max:50','description'=>'nullable|string|max:255'])); return redirect()->route('admin.expenses.index')->with('success','Record updated successfully.'); }
    public function destroy(Expense $item) { $item->delete(); return back()->with('success','Record deleted successfully.'); }
}