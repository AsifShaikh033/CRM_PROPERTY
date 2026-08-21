<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Service listing
     */
    public function list()
    {
        $services = Service::orderBy('priority', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('Admin.Service.list', compact('services'));
    }


    /**
     * Store Service
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'short_description' => 'nullable|string|max:500',

            'details' => 'nullable|string',

            'priority' => 'required|integer|min:0',

            'status' => 'required|boolean',

        ]);


        $slug = Str::slug($request->title);


        /*
        |--------------------------------------------------------------------------
        | Make Slug Unique
        |--------------------------------------------------------------------------
        */

        $originalSlug = $slug;

        $count = 1;

        while (
            Service::where('slug', $slug)->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }

         if ($request->hasFile('icon')) {

                $iconPath = $request->file('icon')->store('services/icons', 'public');
         }     

        Service::create([

            'title' => $request->title,

            'slug' => $slug,

            'icon' => $iconPath ?? null,

            'short_description' => $request->short_description,

            'details' => $request->details,

            'priority' => $request->priority,

            'status' => $request->status,

        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Service created successfully.'
            );
    }


    /**
     * Edit Service
     */
    public function service_edit($id)
    {
        $Data = Service::findOrFail($id);

        return view(
            'Admin.Service.edit',
            compact('Data')
        );
    }


    /**
     * Update Service
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'short_description' => 'nullable|string|max:500',

            'details' => 'nullable|string',

            'priority' => 'required|integer|min:0',

            'status' => 'required|boolean',

        ]);


        $service = Service::findOrFail($id);


        $slug = Str::slug($request->title);


        /*
        |--------------------------------------------------------------------------
        | Make Slug Unique During Update
        |--------------------------------------------------------------------------
        */

        $originalSlug = $slug;

        $count = 1;

        while (
            Service::where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }


        $service->title = $request->title;

        $service->slug = $slug;
        if ($request->hasFile('icon')) {
            @unlink(public_path('storage/' . $service->icon));  
            $iconPath = $request->file('icon')->store('services/icons', 'public');
            $service->icon = $iconPath;
        }

        $service->short_description =
            $request->short_description;

        $service->details =
            $request->details;

        $service->priority =
            $request->priority;

        $service->status =
            $request->status;

        $service->save();


        return redirect()
            ->route('admin.service.list')
            ->with(
                'success',
                'Service updated successfully.'
            );
    }


    /**
     * Delete Service
     */
    public function destroy(Request $request)
    {
        $service = Service::findOrFail(
            $request->id
        );

        $service->delete();


        return redirect()
            ->back()
            ->with(
                'success',
                'Service deleted successfully.'
            );
    }
}