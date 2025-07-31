<?php
namespace Modules\User\Models\V1;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number', 'otp_code','expiration_time'
    ];


}
