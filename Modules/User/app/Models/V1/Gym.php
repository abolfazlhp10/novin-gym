<?php

namespace Modules\User\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'logo', 'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
