<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Support\Database\Factories\FeedbackFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'feedback'];
}
