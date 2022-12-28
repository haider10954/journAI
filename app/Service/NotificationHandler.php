<?php

namespace App\Service;

class NotificationHandler
{
    public static function getNotifications()
    {
        $notifications = auth('admin')->user()->unreadNotifications;
        return $notifications;
    }

    public static function markAsRead($id)
    {
        auth('admin')->user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }

    public static function markAllAsRead()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
