<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams');
    }
}
