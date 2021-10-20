<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id', 'experience_id', 'cv', 'drive_license',
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
