<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $items = Owner::latest()->paginate(15);

        return view('admin.owners.index', compact('items'));
    }


    public function create()
    {
        return view('admin.owners.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        Owner::create($data);

        return redirect()
            ->route('admin.owners.index')
            ->with('success', 'Owner created successfully.');
    }


    public function show(Owner $owner)
    {
        return view('admin.owners.show', [
            'item' => $owner
        ]);
    }


    public function edit(Owner $owner)
    {
        return view('admin.owners.edit', [
            'item' => $owner
        ]);
    }


    public function update(Request $request, Owner $owner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        $owner->update($data);

        return redirect()
            ->route('admin.owners.index')
            ->with('success', 'Owner updated successfully.');
    }


    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()
            ->route('admin.owners.index')
            ->with('success', 'Owner deleted successfully.');
    }
}