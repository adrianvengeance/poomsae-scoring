<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    use HasFactory;

    protected $fillable = ['participant_id', 'user_id', 'class_name', 'accuration', 'presentation', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participants::class);
    }

    public function teams()
    {
        return $this->belongsTo(Teams::class);
    }

    public function alreadyJudged($participants, $user_id)
    {
        return Scores::select('participant_id')->whereIn('participant_id', $participants)->where('user_id', $user_id)->get();
    }
}
