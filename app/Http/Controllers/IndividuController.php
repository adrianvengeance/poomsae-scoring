<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use Illuminate\Http\Request;

class IndividuController extends Controller
{
    public function index()
    {
        return view('individu');
    }

    public function activeList()
    {
        $firstPerson = (Participants::where('status', 'active')->first());
        if (!$firstPerson) return abort(404);
        $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : 'Putri';
        // $participantsModel = new Participants();
        $data = [
            'title' => $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category . ' Sesi ' . $firstPerson->session,
            // 'participants'  => $participantsModel->showingActive(),
            // 'colors' => ['white', 'gold', 'ghostwhite', 'saddlebrown', 'saddlebrown']
        ];
        return view('individuActive', $data);
    }

    public function showing()
    {
        $participantsModel = new Participants();
        $title = '';
        $firstPerson = (Participants::where('status', 'active')->first());

        if ($firstPerson) {
            $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : 'Putri';
            $title = $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category . ' Sesi ' . $firstPerson->session;
        }
        $data = [
            'title' => $title,
            'participants'  => $participantsModel->showingActive(),
            'colors' => ['white', 'gold', 'ghostwhite', 'saddlebrown', 'saddlebrown', '']

        ];
        return view('individuShowing', $data);
    }
}
