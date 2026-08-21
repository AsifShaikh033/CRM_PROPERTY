<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class WebConfigController extends Controller
{
    public function edit()
    {
        $settings = WebConfig::pluck('value', 'name');
        return view('Admin.web_config.edit', compact('settings'));
    }


      public function update(Request $request)
    {
        $request->validate([

            'web_title' => 'nullable|string|max:255',

            'tagline' => 'nullable|string|max:1000',

            'primary_email' => 'nullable|email|max:255',

            'support_email' => 'nullable|email|max:255',

            'primary_phone' => 'nullable|string|max:50',

            'secondary_phone' => 'nullable|string|max:50',

            'address' => 'nullable|string|max:1000',

            'facebook_link' => 'nullable|string|max:500',

            'instagram_link' => 'nullable|string|max:500',

            'twitter_link' => 'nullable|string|max:500',

            'youtube_link' => 'nullable|string|max:500',

            'linkedin_link' => 'nullable|string|max:500',

            'primary_color' => 'nullable|string|max:20',

            'secondary_color' => 'nullable|string|max:20',

            'meta_keywords' => 'nullable|string|max:1000',

            'meta_description' => 'nullable|string|max:2000',

            'privacy_policy' => 'nullable|string',

            'terms_conditions' => 'nullable|string',

            'google_map' => 'nullable|string|max:2000',

            'whatsapp_number' => 'nullable|string|max:50',

            'opening_hours' => 'nullable|string|max:1000',

            'smtp_host' => 'nullable|string|max:255',

            'smtp_port' => 'nullable|string|max:20',

            'smtp_username' => 'nullable|string|max:255',

            'smtp_password' => 'nullable|string|max:255',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'footer_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'fav_icon' => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Normal Text Settings
        |--------------------------------------------------------------------------
        */

        $settings = [

            'web_title' => $request->web_title,

            'tagline' => $request->tagline,

            'primary_email' => $request->primary_email,

            'support_email' => $request->support_email,

            'primary_phone' => $request->primary_phone,

            'secondary_phone' => $request->secondary_phone,

            'address' => $request->address,

            'facebook_link' => $request->facebook_link,

            'instagram_link' => $request->instagram_link,

            'twitter_link' => $request->twitter_link,

            'youtube_link' => $request->youtube_link,

            'linkedin_link' => $request->linkedin_link,

            'primary_color' => $request->primary_color,

            'secondary_color' => $request->secondary_color,

            'meta_keywords' => $request->meta_keywords,

            'meta_description' => $request->meta_description,

            'privacy_policy' => $request->privacy_policy,

            'terms_conditions' => $request->terms_conditions,

            'google_map' => $request->google_map,

            'whatsapp_number' => $request->whatsapp_number,

            'opening_hours' => $request->opening_hours,

            'smtp_host' => $request->smtp_host,

            'smtp_port' => $request->smtp_port,

            'smtp_username' => $request->smtp_username,

            'smtp_password' => $request->smtp_password,

        ];


        /*
        |--------------------------------------------------------------------------
        | Save Normal Settings
        |--------------------------------------------------------------------------
        */

        foreach ($settings as $name => $value) {

            WebConfig::updateOrCreate(

                [
                    'name' => $name
                ],

                [
                    'value' => $value
                ]

            );

            Cache::forget('web_setting_' . $name);
        }


        /*
        |--------------------------------------------------------------------------
        | File Uploads
        |--------------------------------------------------------------------------
        */

        $fileFields = [
            'logo',
            'footer_logo',
            'fav_icon',
        ];


        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {

                $path = $request->file($field)->store('uploads/web_config', 'public');
                    
                WebConfig::updateOrCreate(
                    [
                        'name' => $field
                    ],
                    [
                        'value' => $path
                    ]
                );


                Cache::forget('web_setting_' . $field);
            }
        }

        return redirect()->route('admin.webconfig.edit')->with('success', 'Web configuration updated successfully!');
    }
    
    public function bannerSection(Request $request)
    {
        $settings = [
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
        ];

        foreach ($settings as $name => $value) {
            WebConfig::updateOrCreate(
                [
                    'name' => $name
                ],
                [
                    'value' => $value
                ]
            );
            Cache::forget('web_setting_' . $name);
        }

        return redirect()->back()->with('success', 'Banner configuration updated successfully!');
    }
    
    public function aboutSection(Request $request)
    {
        if ($request->isMethod('get')) {
            $about_title = WebConfig::where('name', 'about_title')->first()?->value;
            $about_description = WebConfig::where('name', 'about_description')->first()?->value;
            $about_image = WebConfig::where('name', 'about_image')->first()?->value;
            $our_mission_title = WebConfig::where('name', 'our_mission_title')->first()?->value;
            $our_mission_description = WebConfig::where('name', 'our_mission_description')->first()?->value;
            $our_mission_image = WebConfig::where('name', 'our_mission_image')->first()?->value;
            return view('Admin.web_config.about_section', compact('about_title', 'about_description', 'about_image', 'our_mission_title', 'our_mission_description', 'our_mission_image'));
        }
        $settings = [
            'about_title' => $request->about_title,
            'about_description' => $request->about_description,
           // 'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'our_mission_title' => $request->our_mission_title,
            'our_mission_description' => $request->our_mission_description,
            ];

        foreach ($settings as $name => $value) {
            WebConfig::updateOrCreate(
                [
                    'name' => $name
                ],
                [
                    'value' => $value
                ]
            );
            Cache::forget('web_setting_' . $name);
        }

         /*
            |--------------------------------------------------------------------------
            | About Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('about_image')) {
                $path = $request->file('about_image')->store('uploads/web_config', 'public');
                WebConfig::updateOrCreate(
                    [
                        'name' => 'about_image'
                    ],
                    [
                        'value' => $path
                    ]
                );
                Cache::forget('web_setting_about_image');
            }
          if ($request->hasFile('our_mission_image')) {
                $path = $request->file('our_mission_image')->store('uploads/web_config', 'public');
                WebConfig::updateOrCreate(
                    [
                        'name' => 'our_mission_image'
                    ],
                    [
                        'value' => $path
                    ]
                );
                Cache::forget('web_setting_our_mission_image');
            }


        return redirect()->back()->with('success', 'About configuration updated successfully!');
    }

}
