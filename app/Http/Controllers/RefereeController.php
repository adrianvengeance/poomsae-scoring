<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use App\Models\Scores;
use Illuminate\Http\Request;


class RefereeController extends Controller
{
    public function index()
    {
        $participantsModel = new Participants();
        $firstPerson = (Participants::where('status', 'active')->first());
        if (!$firstPerson) return abort(404);
        $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : 'Putri';
        $data = [
            'participants' => $participantsModel->getJudgingList(auth()->user()->id),
            'title' => $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . '<br>' . $firstPerson->category . ' Sesi ' . $firstPerson->session,
        ];
        return view('referee/activeList', $data);
    }

    public function show($id)
    {
        $participant = Participants::find($id);
        return view('referee/judging', compact('participant'));
    }

    public function submit(Request $req)
    {
        $firstPerson = (Participants::where('status', 'active')->first());
        $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : 'Putri';
        $class = $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category . ' Sesi ' . $firstPerson->session;
        Scores::create([
            'participant_id' => $req->participant_id,
            'user_id'       => auth()->user()->id,
            'class_name'    => $class,
            'accuration'    => $req->accuration,
            'presentation'  => $req->presentation,
            'total'         => $req->total,
        ]);
        return redirect()->to('judging');
    }
}
