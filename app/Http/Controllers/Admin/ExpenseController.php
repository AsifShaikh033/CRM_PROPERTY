<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Property;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $items = Expense::with('property')
            ->latest()
            ->paginate(15);

        return view('Admin.expenses.index', compact('items'));
    }


    public function create()
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('Admin.expenses.create', compact('properties'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
            'description' => 'nullable|string|max:1000',
        ]);

        Expense::create($data);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense created successfully.');
    }


    public function show(Expense $expense)
    {
        $expense->load('property');

        return view('Admin.expenses.show', [
            'item' => $expense
        ]);
    }


    public function edit(Expense $expense)
    {
        $properties = Property::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('Admin.expenses.edit', [
            'item' => $expense,
            'properties' => $properties,
        ]);
    }


    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
            'description' => 'nullable|string|max:1000',
        ]);

        $expense->update($data);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}