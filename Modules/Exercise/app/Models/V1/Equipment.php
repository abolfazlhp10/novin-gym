<?php
namespace Modules\Exercise\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name_fa', 'name_en'];

    protected $table = 'equipments';
}
