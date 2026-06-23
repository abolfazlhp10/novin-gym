<?php

namespace Modules\Exercise\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Exercise\Database\Factories\V1/CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_fa', 'name_en'];
}
