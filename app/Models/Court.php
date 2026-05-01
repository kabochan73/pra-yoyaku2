<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
