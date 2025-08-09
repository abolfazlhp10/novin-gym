<?php
namespace Modules\User\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'phone_number' => $this->phone_number,
            'created_at'   => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i'),
            'updated_at'   => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i'),
            'token'        => $this->when($this->token, $this->token),
            'gym'          => new GymResource($this->whenLoaded('gym')),
        ];
    }
}
