<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Captain extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'city_id', 'country_id', 'first_name', 'last_name', 'code', 'email', 'mobile', 'country_code', 'password', 'nationality_id', 'avatar', 'birthday', 'gender',
        'remember_token', 'device_token',
        'front_personal', 'back_personal', 'address', 'cv', 'drive_license', 'car_model', 'address', 'suspend', 'status', 'country_of_residence', 'mobile_verified_at'
    ];

    public function userToken()
    {
        return $this->hasOne(UserToken::class, 'user_id', 'provider_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    } 
    public function subCaptains()
    {
        return $this->hasMany(SubCaptain::class);
    }
}
