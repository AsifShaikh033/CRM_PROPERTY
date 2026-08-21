<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Blog;

class WebController extends Controller
{
   public function index()
   {
       // Fetch active banners sorted by priority
       $banners = Banner::where('status', 1)->orderBy('priority', 'asc')->get();
        $services = Service::where('status', 1)
            ->orderBy('priority', 'asc')
            ->take(3)
            ->get();
        $blogs = Blog::where('status', 1)
            ->orderBy('priority', 'asc')
            ->take(3)
            ->get();

       return view('Front.website.home', compact('banners', 'services', 'blogs'));
   }

   public function about()
   {
       return view('Front.website.about');
   }

   public function services()
   {
       $services = Service::where('status', 1)
           ->orderBy('priority', 'asc')
           ->get();
       return view('Front.website.services', compact('services'));
   }
   
   public function serviceDetails($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view(
            'Front.website.service-details',
            compact('service')
        );
    }
   public function blog()
   {
       $blogs = Blog::where('status', 1)
           ->orderBy('priority', 'asc')
           ->get();
       return view('Front.website.blog', compact('blogs'));
   }
   
   public function blogDetails($slug)
   {
       $blog = Blog::where('slug', $slug)
           ->where('status', 1)
           ->firstOrFail();
       return view('Front.website.blog-details', compact('blog'));
   }
   
   public function contact()
   {
       return view('Front.website.contact');
   }
}
