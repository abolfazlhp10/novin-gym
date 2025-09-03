<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Support\Database\Factories\FaqFactory;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'answer'];
}
