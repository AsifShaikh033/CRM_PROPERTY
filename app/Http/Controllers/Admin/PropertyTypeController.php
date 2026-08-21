<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $items = PropertyType::latest()->paginate(15);

        return view('Admin.property-types.index', compact('items'));
    }


    public function create()
    {
        return view('Admin.property-types.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        PropertyType::create($data);

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type created successfully.');
    }


    public function edit(PropertyType $property_type)
    {
        return view('Admin.property-types.edit', [
            'item' => $property_type
        ]);
    }


    public function update(
        Request $request,
        PropertyType $property_type
    ) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $property_type->update($data);

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type updated successfully.');
    }


    public function destroy(PropertyType $property_type)
    {
        $property_type->delete();

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type deleted successfully.');
    }
}