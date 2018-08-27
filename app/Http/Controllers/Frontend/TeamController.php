<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team\Team;
use App\Models\Team\Team_Categories;
use App\User;

class TeamController extends Controller
{
    //

	public function index(){

		$team_cat = Team_Categories::all();
		foreach ($team_cat as $teamcat) {
			$teamcat->team = Team::where('teamCat_id','=',$teamcat->id)->get();
			foreach ($teamcat->team as $team) {
				$team->user =  User::find($team->user_id);
			}
		}


		return view('frontend.team.index', compact('team_cat'));
	}
}
