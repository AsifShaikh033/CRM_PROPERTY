<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebConfig;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [

            'web_title' => 'Dr. Care',

            'web_tagline' =>
                'Advanced healthcare with compassion and modern medical technology.',

            'primary_email' =>
                'contact@test.com',

            'support_email' =>
                'support@test.com',

            'primary_phone' =>
                '+919876543210',

            'secondary_phone' =>
                '+911234567890',

            'address' =>
                '123 Medical Street, City, India',

            'facebook_link' =>
                '#',

            'instagram_link' =>
                '#',

            'twitter_link' =>
                '#',

            'youtube_link' =>
                '#',

            'linkedin_link' =>
                '#',

            'logo' =>
                null,

            'footer_logo' =>
                null,

            'fav_icon' =>
                null,

            'primary_color' =>
                '#e34b91',

            'secondary_color' =>
                '#74143f',

            'meta_keywords' =>
                'doctor, healthcare, clinic, ENT specialist',

            'meta_description' =>
                'Dr. Care provides advanced healthcare and specialist medical consultation.',

            'privacy_policy' =>
                null,

            'terms_conditions' =>
                null,

            'google_map' =>
                null,

            'whatsapp_number' =>
                '+919876543210',

            'opening_hours' =>
                'Monday - Saturday, 09:00 AM - 06:00 PM',

        ];


        foreach ($settings as $name => $value) {

            WebConfig::updateOrCreate(
                ['name' => $name],
                ['value' => $value]
            );

        }
    }
}
