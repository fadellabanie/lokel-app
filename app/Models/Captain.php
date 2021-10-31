<?php

namespace App\Models;

use App\Http\Resources\Captains\CaptainResource;
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
        'remember_token', 'device_token', 'bio', 'rate','number_of_trips','languages','is_smoker',
        'front_personal', 'back_personal', 'address', 'cv', 'drive_license', 'car_model', 'address', 'suspend', 'status', 'country_of_residence', 'mobile_verified_at'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    public function scopeSuspend($query)
    {
        return $query->where('suspend', true);
    }
    public function scopeNotSuspend($query)
    {
        return $query->where('suspend', false);
    }

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
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function subCaptains()
    {
        return $this->hasMany(SubCaptain::class);
    } 
    public function galleries()
    {
        return $this->hasMany(CaptainGallery::class);
    }
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'captain_interest', 'captain_id', 'interest_id');
    }
}
