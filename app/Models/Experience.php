<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    const PENDING = 0;
    const ACCEPT = 1;
    const REJECT = 2;
    const EXPIRED = 3;

    protected $fillable = [
        'city_id', 'country_id', 'captain_id', 'icon', 'title', 'code', 'description', 'thumbnail',
        'duration_type', 'duration', 'price', 'included', 'expect', 'faqs', 'pick_up_address', 'pick_up_lat',
        'pick_up_lng', 'drop_of_address', 'capacity', 'drop_of_lat', 'drop_of_lng', 'meals', 'status'
    ];

    public $with = ['captain','medias'];

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }
    public function scopeAccept($query)
    {
        return $query->where('status', self::ACCEPT);
    }
    public function scopeMine($query)
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
    public function medias()
    {
        return $this->hasMany(ExperienceMedia::class);
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
