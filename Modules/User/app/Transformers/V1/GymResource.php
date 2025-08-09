<?php
namespace Modules\User\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class GymResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'logo'       => $this->logo,
            'address'    => $this->address,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i'),
            'updated_at' => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i'),
        ];
    }
}
