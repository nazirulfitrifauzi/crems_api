<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Storage;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    /**
     * Hash password
     *
     * @var $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the role associated with the user.
     */
    public function roles()
    {
        return $this->hasOne(RefRole::class, 'id', 'role');
    }

    /**
     * Get the account status associated with the user.
     */
    public function accStat()
    {
        return $this->hasOne(RefAccStatus::class, 'id', 'active');
    }

    /**
     * Get avatar url - dekat sini pun boleh , dekat resource pun boleh
     */
    public function getAvatarUrlAttribute()
    {
        return Storage::disk('public')->url($this->avatar);
    }

}
