<?php

namespace App\Models;

use App\Notifications\NoteNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class Note extends Model
{
    use HasFactory;

    use Notifiable;

    protected $guarded = [];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getImage()
    {
        return asset('storage/notes/' . $this->image);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($modal) {
            $admins = Admin::get();
            Notification::send($admins, new NoteNotification($modal));
        });
    }
}
