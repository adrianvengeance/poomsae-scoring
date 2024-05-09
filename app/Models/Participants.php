<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'dojang',
        'type',
        'class',
        'category',
        'session',
        'status',
        'ranking'
    ];

    public function scopeIndividu()
    {
        return Participants::where('type', 'Individual');
    }
}
