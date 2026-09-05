<?php

namespace App\Helpers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationHelper
{
    public static function create(
        string $title,
        string $type,
        string $message,
        int $totalUsers = 0
    ) {
        return Notification::create([
            'title'       => $title,
            'type'        => $type,
            'message'     => $message,
            'total_users' => $totalUsers,
            'from_user_id'=> Auth::id(),
            'read_at'     => null,
        ]);
    }

    public static function getNotifications($limit = 10)
    {
        return Notification::latest()
            ->take($limit)
            ->get();
    }

    public static function getUnreadCount()
    {
        return Notification::whereNull('read_at')->count();
    }
}