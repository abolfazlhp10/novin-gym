<?php
namespace Modules\Exercise\Services\V1;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Modules\Exercise\Models\V1\Exercise;

class ExerciseService
{
    public function getAll()
    {
        return Exercise::all();
    }

    public function create(array $data)
    {
        if (Arr::has($data, 'video')) {
            $path = Storage::disk('public')->put('exercises', $data['video']);

            $data['video'] = $path;
        }

        return Exercise::create($data);
    }

    public function update(Exercise $exercise, array $data)
    {
        if (Arr::has($data, 'video')) {
            if ($exercise->video) {
                Storage::disk('public')->delete($exercise->video);
            }

            $path = Storage::disk('public')->put('exercises', $data['video']);
            $data['video'] = $path;
        }

        $exercise->update($data);

        $exercise->refresh();

        return $exercise;
    }

    public function delete(Exercise $exercise)
    {
        if ($exercise->video) {
            Storage::disk('public')->delete($exercise->video);
        }
        $exercise->delete();
    }
}
