<?php
namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\User\Enums\RoleEnum;
use Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Models\Gym;
use Modules\User\Models\User;

class UserService
{
    public function register(RegisterUserRequest $request): User | bool
    {
        DB::beginTransaction();

        try {

            $user = $this->createUser($request);

            $user->assignRole(RoleEnum::COACH->value);

            $this->createGym($request, $user->id);

            DB::commit();

            return $user->load(['gym']);

        } catch (\Throwable $e) {
            DB::rollBack();
            logError('critical', 'Error on the user register : ', $e);
            return false;
        }
    }

    protected function createUser(RegisterUserRequest $request): User
    {
        return User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
    }

    protected function createGym(RegisterUserRequest $request, $user_id): void
    {
        Gym::create([
            'name'    => $request->gym_name,
            'user_id' => $user_id,
        ]);
    }

}
