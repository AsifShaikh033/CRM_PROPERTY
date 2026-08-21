<?php

use App\Models\WebConfig;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

if (!function_exists('webConfig')) {
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function webConfig($name, $default = null)
    {
          return Cache::remember(
            'web_setting_' . $name,
            now()->addHours(6),
            function () use ($name, $default) {

                return WebConfig::where('name', $name)
                    ->value('value') ?? $default;

            }
        );
    }
}


 

