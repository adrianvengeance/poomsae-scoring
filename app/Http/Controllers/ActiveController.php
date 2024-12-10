<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveController extends Controller
{

  public function activeList()
  {
    $firstPerson = (Participants::where('status', 'active')->first());
    if (!$firstPerson) return abort(404);
    $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : (strtolower($firstPerson->gender) == 'f' ? 'Putri' : '');
    $participantsModel = new Participants();
    $data = [
      // 'title' => $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category . ' Sesi ' . $firstPerson->session,
      'title' => $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category,
      'participants' => $participantsModel->showingActive(),
      // 'colors' => ['white', 'gold', 'ghostwhite', 'saddlebrown', 'saddlebrown']
    ];
    return view('active', $data);
  }

  public function showing()
  {
    $participantsModel = new Participants();
    $title = '';
    $firstPerson = (Participants::where('status', 'active')->first());


    if ($firstPerson) {
      $gender = strtolower($firstPerson->gender) == 'm' ? 'Putra' : (strtolower($firstPerson->gender) == 'f' ? 'Putri' : '');
      // $title = $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category . ' Sesi ' . $firstPerson->session;
      $title = $firstPerson->type . ' ' . $gender . ' ' . $firstPerson->class . ' ' . $firstPerson->category;
    }
    $data = [
      'team' => $firstPerson->type == 'INDIVIDUAL' ? false : true,
      'title' => $title,
      'participants' => $participantsModel->showingActive(),
      'colors' => ['white', 'gold', 'ghostwhite', 'saddlebrown', 'saddlebrown', '']

    ];
    return view('showing', $data);
  }
}
