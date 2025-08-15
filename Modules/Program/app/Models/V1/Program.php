<?php
namespace Modules\Program\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Program\Database\Factories\V1/ProgramFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'phone_number', 'coach_id', 'meta_data', 'description'];

    protected $casts = [
        'meta_data' => 'array',
    ];
}
