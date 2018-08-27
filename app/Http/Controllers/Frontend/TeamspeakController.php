<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamspeakController extends Controller
{
    //
    //
    public function index() 
    {
    	return view('frontend.teamspeak.index');
    }
}
