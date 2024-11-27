<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use App\Models\Scores;
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
        $data = Participants::all();
        return view('data', compact('data'));
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

        foreach ($array as $i => $value) {
            if ($i == 0) continue;

            Participants::create([
                'name' => $value[0],
                'birthdate' => $value[1],
                'gender' => $value[2],
                'dojang' => $value[3],
                'type' => $value[4],
                'class' => $value[5],
                'category' => $value[6],
                'session' => $value[7],
            ]);
        }

        session()->flash('inserted', 'File excel ' . $fileName . ' uploaded successfully!');
        return redirect()->back();
    }

    public function showHistory()
    {
        return view('history');
    }
}
