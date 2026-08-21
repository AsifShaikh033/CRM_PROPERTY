<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with(['propertyType','owner'])
            ->when($request->search, function($q,$v){
                $q->where(function($q) use ($v){
                    $q->where('name','like',"%$v%")
                      ->orWhere('property_code','like',"%$v%");
                });
            })
            ->when($request->status, fn($q,$v)=>$q->where('status',$v))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create', [
            'types'=>PropertyType::where('status','active')->get(),
            'owners'=>Owner::where('status','active')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'property_code'=>'required|string|max:100|unique:properties,property_code',
            'property_type_id'=>'required|exists:property_types,id',
            'owner_id'=>'nullable|exists:owners,id',
            'phone'=>'nullable|string|max:30',
            'email'=>'nullable|email|max:255',
            'address'=>'nullable|string',
            'city'=>'nullable|string|max:100',
            'state'=>'nullable|string|max:100',
            'country'=>'required|string|max:100',
            'total_units'=>'required|integer|min:1',
            'monthly_rent'=>'nullable|numeric|min:0',
            'status'=>'required|in:active,draft,inactive',
            'description'=>'nullable|string',
            'amenities'=>'nullable|array',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if($request->hasFile('image'))
            $data['image']=$request->file('image')->store('properties','public');

        Property::create($data);

        return redirect()->route('admin.properties.index')->with('success','Property created successfully.');
    }

    public function show(Property $property)
    {
        $property->load(['propertyType','owner','units']);
        return view('admin.properties.show',compact('property'));
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit',[
            'property'=>$property,
            'types'=>PropertyType::where('status','active')->get(),
            'owners'=>Owner::where('status','active')->get(),
        ]);
    }

    public function update(Request $request,Property $property)
    {
        $data=$request->validate([
            'name'=>'required|string|max:255',
            'property_code'=>'required|string|max:100|unique:properties,property_code,'.$property->id,
            'property_type_id'=>'required|exists:property_types,id',
            'owner_id'=>'nullable|exists:owners,id',
            'phone'=>'nullable|string|max:30',
            'email'=>'nullable|email|max:255',
            'address'=>'nullable|string',
            'city'=>'nullable|string|max:100',
            'state'=>'nullable|string|max:100',
            'country'=>'required|string|max:100',
            'total_units'=>'required|integer|min:1',
            'monthly_rent'=>'nullable|numeric|min:0',
            'status'=>'required|in:active,draft,inactive',
            'description'=>'nullable|string',
            'amenities'=>'nullable|array',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if($request->hasFile('image')){
            if($property->image) Storage::disk('public')->delete($property->image);
            $data['image']=$request->file('image')->store('properties','public');
        }

        $property->update($data);

        return redirect()->route('admin.properties.index')->with('success','Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        if($property->image) Storage::disk('public')->delete($property->image);
        $property->delete();
        return back()->with('success','Property deleted successfully.');
    }

    public function units(Property $property)
    {
        $property->load('units');
        return view('admin.properties.units',compact('property'));
    }
}