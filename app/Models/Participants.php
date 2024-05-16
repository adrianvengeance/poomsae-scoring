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

    public function scores()
    {
        return $this->hasMany(Scores::class);
    }

    public function getJudgingList($userId)
    {
        $data = Participants::where('status', 'active')->leftJoin('scores', function ($join) use ($userId) {
            $join->on('participants.id', '=', 'scores.participant_id')->where('scores.user_id', $userId);
        })->select('participants.id', 'participants.name', 'participants.dojang', 'scores.accuration', 'scores.presentation', 'scores.total')->get();

        return $data;
    }
}
