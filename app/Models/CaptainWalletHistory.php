<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptainWalletHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_id', 'address', 'cv', 'drive_license',
    ];

    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
}
