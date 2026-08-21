<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Blog listing
     */
    public function list()
    {
        $blogs = Blog::orderBy('priority', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'Admin.Blog.list',
            compact('blogs')
        );
    }


    /**
     * Store Blog
     */
    public function store(Request $request)
    {
       
        $request->validate([

            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'priority' => 'required|integer|min:0',
            'status' => 'required|boolean',
            //'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|max:1000',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->title);

        $originalSlug = $slug;

        $count = 1;

        while (
            Blog::where('slug', $slug)->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('blogs', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Create Blog
        |--------------------------------------------------------------------------
        */

        Blog::create([
            'user_id' => auth('admin')->id(),
            'title' => $request->title,

            'slug' => $slug,

            'image' => $imagePath,

            'short_description' =>
                $request->short_description,

            'description' =>
                $request->description,

            'author' =>
                $request->author,

            'priority' =>
                $request->priority,

            'status' =>
                $request->status,

            'published_at' => now(),
               

            'meta_title' =>
                $request->meta_title,

            'meta_keywords' =>
                $request->meta_keywords,

            'meta_description' =>
                $request->meta_description,

        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Blog created successfully.'
            );
    }


    /**
     * Edit Blog
     */
    public function blog_edit($id)
    {
        $Data = Blog::findOrFail($id);

        return view(
            'Admin.Blog.edit',
            compact('Data')
        );
    }


    /**
     * Update Blog
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            'short_description' => 'nullable|string|max:500',

            'description' => 'nullable|string',

            'author' => 'nullable|string|max:255',

            'priority' => 'required|integer|min:0',

            'status' => 'required|boolean',

            //'published_at' => 'nullable|date',

            'meta_title' => 'nullable|string|max:255',

            'meta_keywords' => 'nullable|string',

            'meta_description' => 'nullable|string|max:1000',

        ]);


        $blog = Blog::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->title);

        $originalSlug = $slug;

        $count = 1;

        while (
            Blog::where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }


        /*
        |--------------------------------------------------------------------------
        | Update Basic Data
        |--------------------------------------------------------------------------
        */

        $blog->title = $request->title;

        $blog->slug = $slug;

        $blog->short_description =
            $request->short_description;

        $blog->description =
            $request->description;

        $blog->author =
            $request->author;

        $blog->priority =
            $request->priority;

        $blog->status =
            $request->status;

        $blog->published_at =
            $request->published_at;

        $blog->meta_title =
            $request->meta_title;

        $blog->meta_keywords =
            $request->meta_keywords;

        $blog->meta_description =
            $request->meta_description;


        /*
        |--------------------------------------------------------------------------
        | Update Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $blog->image &&
                Storage::disk('public')->exists($blog->image)
            ) {

                Storage::disk('public')
                    ->delete($blog->image);

            }


            $blog->image = $request
                ->file('image')
                ->store('blogs', 'public');
        }


        $blog->save();


        return redirect()
            ->route('admin.blog.list')
            ->with(
                'success',
                'Blog updated successfully.'
            );
    }


    /**
     * Delete Blog
     */
    public function destroy(Request $request)
    {
        $blog = Blog::findOrFail(
            $request->id
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if (
            $blog->image &&
            Storage::disk('public')->exists($blog->image)
        ) {

            Storage::disk('public')
                ->delete($blog->image);

        }


        $blog->delete();


        return redirect()
            ->back()
            ->with(
                'success',
                'Blog deleted successfully.'
            );
    }
}