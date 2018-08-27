<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_tournament;
use App\Models\Event\event_tournament_type;
use App\Models\Event\event_tournament_player;
use App\Models\Event\event_tournament_matches;
use App\Models\Event\event_tournament_teams;
use App\Models\Event\event_users;
use App\Models\Games\games;

use App\User;
use Auth;
use Session;


class TournamentController extends Controller
{

	
	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//

		$tournaments = event_tournament::all();
		foreach ($tournaments as $tournament) {
			$tournament->event =  event::find($tournament->event_id);
			$tournament->teams =  event_tournament_teams::where('tournament_id', $tournament->id)->get();
		}

		return view('backend.event.tournament.index', compact('tournaments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$events =  event::all();
		$types =  event_tournament_type::all();
		$users =  User::all();
		$games = games::all();

		return view('backend.event.tournament.create', compact('events', 'types','users','games'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$tournament =  new event_tournament();
		$tournament->event_id = $request->input('event');
		$tournament->games_id = $request->input('game');
		$tournament->name = $request->input('name');
		$tournament->start = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));
		$tournament->end = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		$tournament->maxTeams = $request->input('maxTeams');
		$tournament->playerPerTeam = $request->input('playerPerTeam');
		$tournament->watcher1_id = $request->input('watcher1');
		$tournament->watcher2_id = $request->input('watcher2');
		$tournament->type_id = $request->input('type');

		$tournament->save();

		// $this->createByeTeam($tournament);
		switch ($tournament->type_id) {
			case 1:
				# SingleElimination
			$this->SingleElimination($tournament);
			break;
			case 2:
				# Double Elimination
			$this->DoubleElimination($tournament);
			break;			
			case 3:
				# Season
			$this->Season($tournament);
			break;
			default:

			break;
		}
		// echo "ready";
		flash('Tournament: ' . $tournament->name . ' saved')->important();

		return redirect()->route('eventTournament.index');
	}

	// function createByeTeam($tournament)
	// {
	// 	$team = new event_tournament_teams();
	// 	$team->tournament_id = $tournament->id;
	// 	$team->name = 'BYE';
	// 	$team->win = 0;
	// 	$team->lose = 0;
	// 	$team->save();

	// }

	function SingleElimination($tournament)
	{
		$rounds = 0;
		//Rounds festlegen
		switch ($tournament->maxTeams) {
			case 2:
			$rounds = 1;
			break;
			case 4:
			$rounds = 2;
			break;
			case 8:
			$rounds = 3;
			break;
			case 16:
			$rounds = 4;
			break;
			case 32:
			$rounds = 5;
			break;
			case 64:
			$rounds = 6;
			break;
			case 128:
			$rounds = 7;
			break;
			default:
			$rounds = 0;
			break;
		}

		//teams - 2 per match
		//if teams are empty then next round with least team/half of pre round 
		//Create all Game Entries

		$maxGames = $tournament->maxTeams - 1;
		$teams = $tournament->maxTeams;
		$preRoundTeams = $teams * 2;
		//Runde

		$gameNumber = 1;
		for ($j=0; $j < $rounds; $j++) { 

			$teamsThisRound = $preRoundTeams/2;
			if ($j == 1) {
				
				$preRoundMatches =  $matchesThisRound;
				$t_count = 0;
			}

			$matchesThisRound = $teamsThisRound/2;
	// Matches in der Round
			for ($i=0; $i < $matchesThisRound ; $i++) { 

				$newMatch =  new event_tournament_matches();
				$newMatch->tournament_id = $tournament->id;
				if (isset($preRoundMatches)) {
					$t_count = $t_count + 1;
					$newMatch->t1_pre = $t_count;
					$t_count = $t_count + 1;
					$newMatch->t2_pre = $t_count;
				}else{
					
					$newMatch->t1_pre = NULL;
					$newMatch->t2_pre = NULL;
				}
				$newMatch->t1_id = NULL; //Null einfügen statt BYE; BYE muss dann im Frontend hinterlegt werden
				$newMatch->t2_id = NULL;
				$newMatch->round =  $j;
				$newMatch->number = $gameNumber;
				$gameNumber++;
				$newMatch->save();
			}	
			$preRoundTeams = $teamsThisRound;
		}
	}

	function DoubleElimination($tournament)
	{
		//Create all Game Entries
		$rounds = 0;
		//Rounds festlegen
		switch ($tournament->maxTeams) {
			case 2:
			$rounds = 1;
			break;
			case 4:
			$rounds = 3;
			break;
			case 8:
			$rounds = 4;
			break;
			case 16:
			$rounds = 5;
			break;
			case 32:
			$rounds = 6;
			break;
			case 64:
			$rounds = 7;
			break;
			case 128:
			$rounds = 8;
			break;
			default:
			$rounds = 0;
			break;
		}

		//teams - 2 per match
		//if teams are empty then next round with least team/half of pre round 

		//Create all Game Entries

		//WinnerBracket
		$maxGames = $tournament->maxTeams - 1;
		$teams = $tournament->maxTeams;
		$preRoundTeams = $teams * 2;
		$lbTeams = 0;
		$gameNumber = 1;
		//Runde
		for ($j=0; $j < $rounds; $j++) 
		{ 

			if ($j < $rounds - 1) 
			{
				$teamsThisRound = $preRoundTeams/2;
				$matchesThisRound = $teamsThisRound/2;

				for ($i=0; $i < $matchesThisRound ; $i++) 
				{ 

					$newMatch =  new event_tournament_matches();
					$newMatch->tournament_id = $tournament->id;
					$newMatch->t1_id = NULL; 
					$newMatch->t2_id = NULL;
					$newMatch->round =  $j;
					$newMatch->number = $gameNumber;
					$gameNumber++;
					$newMatch->save();

					$lbTeams = $lbTeams + 1;
				}
			//after first Round start Loser Bracket
			//LoserBracket
				if ($j >= 0) 
				{
					$lbGames = $lbTeams / 2;
					for ($i=0; $i < $lbGames; $i++) 
					{ 

						$newMatch =  new event_tournament_matches();
						$newMatch->tournament_id = $tournament->id;
						$newMatch->t1_id = NULL; 	
						$newMatch->t2_id = NULL;
						$newMatch->round =  $j;
						$newMatch->winBracket = 0;
						$newMatch->number = $gameNumber;
						$gameNumber++;
						$newMatch->save();

						$lbTeams = $lbTeams - 1;
					}
				}
				$preRoundTeams = $teamsThisRound;
			}
			else
			{

				$newMatch =  new event_tournament_matches();
				$newMatch->tournament_id = $tournament->id;
				$newMatch->t1_id = NULL; 	
				$newMatch->t2_id = NULL;
				$newMatch->round =  $j;
				$newMatch->number = $gameNumber;
				$gameNumber++;
				$newMatch->winBracket = 1;
				$newMatch->save();
			}
		}
		//Win vs Lose Bracket

	}

	function Season($tournament)
	{
		//Create all Game Entries
		echo "not Season not implemented yet";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$tournament  = event_tournament::find($id);
		$tournament->event =  event::find($tournament->event_id);
		$tournament->watcher1 =  User::find($tournament->watcher1_id);
		$tournament->watcher2 =  User::find($tournament->watcher2_id);
		$tournament->game = games::find($tournament->games_id);
		$tournament->type = event_tournament_type::find($tournament->type_id);

		$events =  event::all();
		$types =  event_tournament_type::all();
		$users =  User::all();
		$games = games::all();

		return view('backend.event.tournament.edit', compact('events', 'types','users','games','tournament'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$tournament =  event_tournament::find($id);
		$tournament->event_id = $request->input('event');
		$tournament->games_id = $request->input('game');
		$tournament->name = $request->input('name');
		$tournament->start = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));
		$tournament->end = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		$tournament->maxTeams = $request->input('maxTeams');
		$tournament->playerPerTeam = $request->input('playerPerTeam');
		$tournament->watcher1_id = $request->input('watcher1');
		$tournament->watcher2_id = $request->input('watcher2');
		$tournament->type_id = $request->input('type');

		$tournament->save();

		event_tournament_matches::where('tournament_id',$tournament->id)->delete();

		// $this->createByeTeam($tournament);
		switch ($tournament->type_id) {
			case 1:
				# SingleElimination
			$this->SingleElimination($tournament);
			break;
			case 2:
				# Double Elimination
			$this->DoubleElimination($tournament);
			break;			
			case 3:
				# Season
			$this->Season($tournament);
			break;
			default:

			break;
		}

		flash('Tournament: ' . $tournament->name . ' saved')->important();

		return redirect()->route('eventTournament.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$tournament = event_tournament::find($id);
		$tournament->delete();
		$tournament_matches = event_tournament_matches::where('tournament_id',$id)->get();

		foreach ($tournament_matches as $match) {
			
			$match->delete();
		}

		return back();
	}

	public function createGamePlan($id)
	{
		echo "create Gameplan <br/>";

		// $tournament =  event_tournament::find($id);

		// echo "$tournament";
		// $registerdTeams =  event_tournament_teams::where('tournament_id','=',$tournament->id)->get();
		// $registerdTeamCount =  $registerdTeams->count();
		// $b =  false;
		// $n = 12;


		// while ($b == false) {
		// 	if(($n & ($n - 1)) == 0)
		// 	{
		// 		$teamsToPlay = $n;
		// 		$b =  true;
		// 	}
		// 	$n++;
		// }

		// echo "<br/> Teams to Play $teamsToPlay <br />";


		// foreach ($variable as $key => $value) {
		// 	# code...
		// }

	}


}
