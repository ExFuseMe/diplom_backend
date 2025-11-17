<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function loginUser(array $validated)
    {
        if (!auth()->attempt($validated)) {
            return false;
        }

        return User::where('email', $validated['email'])->first();
    }

    public function getUserInstance()
    {
        return auth()->user();
    }

    public function registerUser(array $validated)
    {
        try{
            DB::beginTransaction();
            return User::create($validated);
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function verifyEmail(array $validated)
    {
        $user = User::where('email', $validated['email'])->first();
        $code = $validated['code'];

        $cacheValue = Cache::get(md5($validated['email']));

        if ($code != $cacheValue) {
            return false;
        }else{
            Cache::forget(md5($validated['email']));
            $user->update(['email_verified_at' => now()]);
            return $user;
        }
    }
}
