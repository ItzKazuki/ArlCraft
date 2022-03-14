<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\AccountCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ProfileUpdateNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createToken()
    {
        return Str::random(64);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the Account created notification.
     *
     * @param string $token
     * @param string $user
     */
    public function accountCreatedNotification($user, $token)
    {
        $this->notify(new AccountCreated($user, $token ?? null));
    }

    /**
     * Send the profile update notification.
     *
     */
    public function profileUpdateNotification()
    {
        $this->notify(new ProfileUpdateNotification());
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim( $this->email )));
    }

    public function announcements()
    {
        return $this->morphMany(Announcement::class, 'annouced')->orderBy('created_at', 'desc');
    }

    public function readAnnouncements()
    {
        return $this->announcements()->read();
    }

    public function unreadAnnouncements()
    {
        return $this->announcements()->unread();
    }
}
