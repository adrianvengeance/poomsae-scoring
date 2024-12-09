<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Participants;
use App\Models\Scores;
use App\Models\Teams;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpParser\Node\Stmt\Continue_;

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
            'files' => "Last upload is " . $file,
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

        $this->insertIndividual($array);
        $this->insertPair($array);
        $this->insertGroup($array);

        session()->flash('inserted', 'File excel ' . $fileName . ' uploaded successfully!');
        return redirect()->back();
    }

    private function insertIndividual($array)
    {
        foreach ($array as $i => $value) {
            if ($i == 0) continue;
            if ($value[0] == 'end') break;
            if ($value[4] == 'PAIR') break;
            if ($value[4] == 'GROUP') break;

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
    }

    private function insertPair($array)
    {
        $newArray = [];
        foreach ($array as $i => $value) {
            if ($i == 0) continue;
            if ($value[4] == 'INDIVIDUAL') continue;
            if ($value[0] == 'end') break;
            if ($value[4] == 'GROUP') break;

            $newArray[] = [
                $value[0],
                $value[1],
                $value[2],
                $value[3],
                $value[4],
                $value[5],
                $value[6]
            ];
        }
        for ($x = 0; $x < count($newArray); $x += 2) {
            if (isset($newArray[$x + 1])) {
                if ($newArray[$x][3] == $newArray[$x + 1][3] && $newArray[$x][5] == $newArray[$x + 1][5]) {
                    Participants::create([
                        'name' => $this->nameResolver($newArray[$x][0]) . " - " . $this->nameResolver($newArray[$x + 1][0]),
                        'birthdate' => null,
                        'gender' => null,
                        'dojang' => $newArray[$x][3],
                        'type' => $newArray[$x][4],
                        'class' => $newArray[$x][5],
                        'category' => $newArray[$x][6]
                        // 'session' => 
                    ]);
                }
            }
        }
    }

    private function insertGroup($array)
    {
        $newArray = [];
        foreach ($array as $i => $value) {
            if ($i == 0) continue;
            if ($value[4] == 'INDIVIDUAL') continue;
            if ($value[4] == 'PAIR') continue;
            if ($value[0] == 'end') break;

            $newArray[] = [
                $value[0],
                $value[1],
                $value[2],
                $value[3],
                $value[4],
                $value[5],
                $value[6]
            ];
        }
        for ($x = 0; $x < count($newArray); $x += 3) {
            if (isset($newArray[$x + 2])) {
                if ($newArray[$x][3] == $newArray[$x + 1][3] && $newArray[$x][5] == $newArray[$x + 1][5] && $newArray[$x][3] == $newArray[$x + 2][3] && $newArray[$x][5] == $newArray[$x + 2][5]) {
                    print_r($this->nameResolver($newArray[$x][0]) . " - " . $this->nameResolver($newArray[$x + 1][0]) . " - " . $this->nameResolver($newArray[$x + 2][0]) . '<br>');
                    Participants::create([
                        'name' => $this->nameResolver($newArray[$x][0]) . " - " . $this->nameResolver($newArray[$x + 1][0]) . " - " . $this->nameResolver($newArray[$x + 2][0]),
                        'birthdate' => null,
                        'gender' => null,
                        'dojang' => $newArray[$x][3],
                        'type' => $newArray[$x][4],
                        'class' => $newArray[$x][5],
                        'category' => $newArray[$x][6]
                        // 'session' => 
                    ]);
                }
            }
        }
    }

    private function nameResolver($string)
    {
        $name = explode(' ', $string);
        if (strlen($name[0]) <= 3) {
            return $name[1] ?? $name[0];
        }
        return $name[0];
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
