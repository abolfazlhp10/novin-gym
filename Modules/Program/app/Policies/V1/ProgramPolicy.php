<?php
namespace Modules\Program\Policies\V1;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Program\Models\V1\Program;
use Modules\User\Models\V1\User;

class ProgramPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->hasRole('coach');
    }

    public function delete(User $user, Program $program): bool
    {
        return $user->hasRole('admin') || $user->id === $program->coach_id;
    }

    public function download(User $user, Program $program): bool
    {
        return $user->id === $program->coach_id;
    }

    public function show(User $user, Program $program): bool
    {
        return $user->id === $program->coach_id;

    }

    public function update(User $user, Program $program): bool
    {
        return $user->id === $program->coach_id;

    }

}
