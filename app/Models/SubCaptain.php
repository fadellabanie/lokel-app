<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCaptain extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'captain_id', 'full_name', 'code', 'email', 'mobile', 'password', 'avatar', 'gender',
        'remember_token', 'device_token',
        'front_personal', 'back_personal', 'address', 'cv', 'drive_license', 'car_model', 'address', 'suspend', 'status', 'country_of_residence', 'mobile_verified_at'
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
}
