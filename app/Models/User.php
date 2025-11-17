<?php

namespace App\Models;

use App\Constants\RoleConsts;
use App\Mail\RegisterMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }


    protected static function booted(): void
    {
        parent::booted();

        static::created(function ($user) {

            if (!Config::get('app.is_seeding')){
                $user->assignRole(RoleConsts::STUDENT);

                $cacheKey = md5($user->email);

                $code = random_int(100000, 999999);

                Cache::put($cacheKey, $code, now()->addMinutes(10));

                Mail::to($user->email)->send(new RegisterMail($code));
            }
        });
    }
}
