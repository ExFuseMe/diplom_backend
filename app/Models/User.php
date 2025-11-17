<?php

namespace App\Models;

use App\Constants\RoleConsts;
use App\Mail\RegisterMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'second_name',
        'last_name',
        'phone',
        'group',
        'vk',
        'birthday',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }

    protected static function booted(): void
    {
        parent::booted();

        static::created(function ($user) {

            $user->assignRole(RoleConsts::STUDENT);

            $cacheKey = md5($user->email);

            $code = random_int(100000, 999999);

            Cache::put($cacheKey, $code, now()->addMinutes(10));

            Mail::to($user->email)->send(new RegisterMail($code));
        });
    }
}
