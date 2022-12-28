<?php

namespace App\Service;

class NotificationHandler
{
    public static function getNotifications()
    {
        $notifications = auth('admin')->user()->unreadNotifications;
        return $notifications;
    }

    public static function markAsRead()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public static function markAllAsRead()
    {
        foreach (auth('admin')->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
