<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'participant_id2',
        'participant_id3',
        'name',
        'dojang',
        'type',
        'class',
        'category',
        'session',
        'status',
        'ranking'
    ];
}
