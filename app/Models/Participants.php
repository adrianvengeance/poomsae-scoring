<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function scopeActiveIndividu()
    {
        // its fuckin workssss
        // $participants = Participants::leftJoin('scores', 'participants.id', '=', 'scores.participant_id')->select(
        //     'participants.id',
        //     'participants.name',
        //     'participants.dojang',
        //     DB::raw('GROUP_CONCAT(scores.accuration ORDER BY scores.id ASC) as accuration_scores'),
        //     DB::raw('GROUP_CONCAT(scores.presentation ORDER BY scores.id ASC) as presentation_scores'),
        //     DB::raw('SUM(scores.accuration) as accuration_total'),
        //     DB::raw('SUM(scores.presentation) as presentation_total'),
        // )->where('status', 'active')->groupBy('participants.id', 'participants.name', 'participants.dojang')->get();

        // $participants = $participants->map(function ($participant) {
        //     $accuration_scores = explode(',', $participant->accuration_scores);
        //     $presentation_scores = explode(',', $participant->presentation_scores);
        //     $participant->total = number_format((($participant->accuration_total + $participant->presentation_total) / 3), 2, '.', '');
        //     $participant->accuration_scores = $accuration_scores;
        //     $participant->presentation_scores = $presentation_scores;
        //     return $participant;
        // });



        $participants = Participants::leftJoin('scores', 'participants.id', '=', 'scores.participant_id')
            ->select(
                'participants.id',
                'participants.name',
                'participants.dojang',
                'participants.ranking',
                DB::raw('GROUP_CONCAT(scores.accuration ORDER BY scores.id ASC) as acc_scores'),
                DB::raw('GROUP_CONCAT(scores.presentation ORDER BY scores.id ASC) as pre_scores'),
                DB::raw('SUM(scores.accuration) as sum_acc'),
                DB::raw('SUM(scores.presentation) as sum_pre'),
                DB::raw('SUM((scores.accuration + scores.presentation)/6) as total')
            )
            ->where('status', 'active')
            ->groupBy('participants.id', 'participants.name', 'participants.dojang')
            ->orderBy('total', 'desc')
            ->orderBy('sum_pre', 'desc');

        return ($participants);
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

    public function showingActive()
    {
        //  its damn worksss but cannot go to laravel-views
        $participants = Participants::leftJoin('scores', 'participants.id', '=', 'scores.participant_id')
            ->select(
                'participants.id',
                'participants.name',
                'participants.dojang',
                'participants.ranking',
                DB::raw('GROUP_CONCAT(scores.accuration ORDER BY scores.id ASC) as acc_scores'),
                DB::raw('GROUP_CONCAT(scores.presentation ORDER BY scores.id ASC) as pre_scores'),
                DB::raw('SUM(scores.accuration) as sum_acc'),
                DB::raw('SUM(scores.presentation) as sum_pre')
            )
            ->where('status', 'active')
            ->groupBy('participants.id', 'participants.name', 'participants.dojang')->get();

        $participants = $participants->map(function ($participant) {
            $acc_scores = explode(',', $participant->acc_scores);
            $pre_scores = explode(',', $participant->pre_scores);
            $participant->sum_acc = (float) $participant->sum_acc;
            $participant->sum_pre = (float) $participant->sum_pre;
            $participant->total = (float) number_format((($participant->sum_acc + $participant->sum_pre) / 6), 1, '.', '');
            $participant->acc_scores = $acc_scores;
            $participant->pre_scores = $pre_scores;
            return $participant;
        });

        $participants = $participants->sort(function ($a, $b) {
            if ($a->total == $b->total) {
                return $b->sum_pre <=> $a->sum_pre;
            }
            return $b->total <=> $a->total;
        });

        return ($participants);
    }

    // public function createPair()
    // {
    //     $allPair = Participants::where('type', 'pair')->get();
    //     $teamedPair = [];
    //     for ($i = 0; $i < count($allPair); $i += 2) {
    //         if (isset($allPair[$i + 1])) {
    //             $teamedPair[] = [$allPair[$i], $allPair[$i + 1]];
    //         }
    //     }

    //     for ($x = 0; $x < count($teamedPair); $x++) {
    //         if ($teamedPair[$x][0]->dojang == $teamedPair[$x][1]->dojang && $teamedPair[$x][0]->class == $teamedPair[$x][1]->class) {
    //             Teams::create([
    //                 'participant_id' => $teamedPair[$x][0]->id,
    //                 'participant_id2' => $teamedPair[$x][1]->id,
    //                 'name' => $this->nameResolver($teamedPair[$x][0]->name) . ' - ' . $this->nameResolver($teamedPair[$x][1]->name),
    //                 'dojang' => $teamedPair[$x][0]->dojang,
    //                 'type' => $teamedPair[$x][0]->type,
    //                 'class' => $teamedPair[$x][0]->class,
    //                 'category' => $teamedPair[$x][0]->category
    //             ]);
    //         }
    //     }
    // }

    // public function createGroup()
    // {
    //     $allGroup = Participants::where('type', 'group')->get();
    //     $teamedGroup = [];
    //     for ($i = 0; $i < count($allGroup); $i += 3) {
    //         if (isset($allGroup[$i + 2])) {
    //             $teamedGroup[] = [$allGroup[$i], $allGroup[$i + 1], $allGroup[$i + 2]];
    //         }
    //     }

    //     for ($n = 0; $n < count($teamedGroup); $n++) {
    //         if ($teamedGroup[$n][0]->dojang == $teamedGroup[$n][1]->dojang && $teamedGroup[$n][0]->dojang == $teamedGroup[$n][2]->dojang && $teamedGroup[$n][0]->class == $teamedGroup[$n][1]->class && $teamedGroup[$n][0]->class == $teamedGroup[$n][2]->class) {
    //             Teams::create([
    //                 'participant_id' => $teamedGroup[$n][0]->id,
    //                 'participant_id2' => $teamedGroup[$n][1]->id,
    //                 'participant_id3' => $teamedGroup[$n][2]->id,
    //                 'name' => $this->nameResolver($teamedGroup[$n][0]->name) . ' - ' . $this->nameResolver($teamedGroup[$n][1]->name) . ' - ' . $this->nameResolver($teamedGroup[$n][2]->name),
    //                 'dojang' => $teamedGroup[$n][0]->dojang,
    //                 'type' => $teamedGroup[$n][0]->type,
    //                 'class' => $teamedGroup[$n][0]->class,
    //                 'category' => $teamedGroup[$n][0]->category
    //             ]);
    //         }
    //     }
    // }

    private function nameResolver($string)
    {
        $name = explode(' ', $string);
        if (strlen($name[0]) <= 3) {
            return $name[1];
        }
        return $name[0];
    }
}
