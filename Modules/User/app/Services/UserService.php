<?php

namespace Modules\User\Services;

use  Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Enums\RoleEnum;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function register(RegisterUserRequest $request) : User | bool
    {
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'role' => RoleEnum::COACH
            ]);

            return $user;
 
        } catch (\Throwable $e) {
            Log::critical('Error on the user register: ' . $e->getMessage().' in : '.$e->getFile().' on line : '.$e->getLine());
            return false;
        }
    }

}