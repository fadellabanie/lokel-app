<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    const PENDING = 1;
    const REJECT = 2;
    const ACCEPT = 3;
    const EXPIRED = 4;

    protected $fillable = [
        'city_id', 'country_id', 'captain_id', 'icon', 'title', 'code', 'description', 'thumbnail',
        'duration_type', 'duration', 'price', 'included', 'expect', 'faqs', 'pick_up_address', 'pick_up_lat',
        'pick_up_lng', 'dropp_of_address', 'capacity', 'dropp_of_lat', 'dropp_of_lng', 'meals', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::ACCEPT);
    }
    public function scopeMy($query)
    {
        return $query->where('captain_id', Auth::id());
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'experience_passenger', 'experience_id', 'passenger_id')->withTimestamps();
    }
}
