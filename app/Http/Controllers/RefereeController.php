<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use Illuminate\Http\Request;

class RefereeController extends Controller
{
    public function index()
    {
        $firstPerson = (Participants::where('status', 'active')->first());
        $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : 'Putri';
        $data = [
            'participants' => Participants::where('status', 'active')->get(),
            'title' => $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' Sesi ' . $firstPerson->session,
        ];
        // dd($data);
        return view('referee/activeList', $data);
    }
}
