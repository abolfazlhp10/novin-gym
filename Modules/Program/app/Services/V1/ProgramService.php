<?php

namespace Modules\Program\Services\V1;

use Modules\Program\Models\V1\Program;
use Modules\User\Models\V1\User;

class ProgramService
{
    public function getAll(User $user)
    {
        if ($user->hasRole('admin')) {
            return Program::all();
        }

        return Program::where('coach_id', $user->id)->paginate(15);
    }

    public function create(User $user, array $data)
    {
        $data['coach_id'] = $user->id;

        return Program::create($data);
    }

    public function update(Program $program, array $data): Program
    {
        $program->update($data);

        return $program->fresh();
    }

    public function delete(Program $program): void
    {
        $program->delete();
    }

    public function getProgramById($programId)
    {
        return Program::findOrFail($programId);
    }
}
