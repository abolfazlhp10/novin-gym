<?php

namespace Modules\Exercise\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => '',
            'name_fa' => $this->name_fa,
            'name_en' => $this->name_en,
            'video' => $this->video,
            'description' => $this->description,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i'),
            'updated_at' => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i'),
        ];
    }
}
