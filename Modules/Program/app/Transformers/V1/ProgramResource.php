<?php

namespace Modules\Program\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'coach_id' => $this->coach_id,
            'user_name' => $this->user_name,
            'phone_number' => $this->phone_number,
            'meta_data' => $this->meta_data,
            'description' => $this->description,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i'),
            'updated_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i'),
        ];
    }
}
