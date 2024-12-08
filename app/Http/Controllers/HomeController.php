<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Participants;
use App\Models\Scores;
use App\Models\Teams;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class HomeController extends Controller
{
    public function showHome()
    {
        return view('home');
    }

    public function showData()
    {
        // $data = Participants::all();
        // return view('data', compact('data'));
        $file = Files::first() ? '"' . Files::latest()->first()->name . '" at ' . Files::latest()->first()->created_at : null;
        $variables = [
            'data' => Participants::all(),
            'files' => $file,
        ];
        return view('data')->with($variables);
    }

    public function upload(Request $req)
    {
        $validated = $req->validate(['file' => 'required|mimes:xls,xlsx']);
        $excel = $validated['file'];
        $fileName = $excel->getClientOriginalName();

        $reader =  new Xlsx();
        $spreadsheet = $reader->load($excel);
        $array = ($spreadsheet->getActiveSheet()->toArray());
        Participants::truncate();
        Scores::truncate();
        Teams::truncate();

        Files::create([
            'name' => $fileName
        ]);

        foreach ($array as $i => $value) {
            if ($i == 0) continue;
            if ($value[0] == 'end') break;
            Participants::create([
                'name' => $value[0],
                'birthdate' => $value[1],
                'gender' => $value[2],
                'dojang' => $value[3],
                'type' => $value[4],
                'class' => $value[5],
                'category' => $value[6],
                // 'session' => $value[7],
            ]);
        }

        session()->flash('inserted', 'File excel ' . $fileName . ' uploaded successfully!');
        return redirect()->back();
    }

    public function createTeams()
    {
        $participantsModel = new Participants();
        $participantsModel->createPair();
        $participantsModel->createGroup();
        session()->flash('created', 'Pair dan Group successfully created!');
        return redirect()->back();
    }

    public function showHistory()
    {
        return view('history');
    }
}
