<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index() { $items=Vendor::latest()->paginate(15); return view('Admin.vendors.index',compact('items')); }
    public function create() { return view('Admin.vendors.create'); }
    public function store(Request $request) { Vendor::create($request->validate(['name'=>'required|string|max:255','email'=>'nullable|email','phone'=>'nullable|string|max:255','company'=>'nullable|string|max:255','status'=>'required|string|max:50'])); return redirect()->route('admin.vendors.index')->with('success','Record created successfully.'); }
   public function show(Vendor $vendor)
    {
        return view('Admin.vendors.show', [
            'item' => $vendor
        ]);
    }

    public function edit(Vendor $vendor)
    {
        return view('Admin.vendors.edit', [
            'item' => $vendor
        ]);
    }
   
    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $vendor->update($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor updated successfully.');
    }

   public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor deleted successfully.');
    }
}