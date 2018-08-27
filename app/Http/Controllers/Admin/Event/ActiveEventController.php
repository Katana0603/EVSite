<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_location;
use App\Models\Event\event_prices;
use App\Models\Event\event_users;
use App\Models\Event\event_user_status;
use App\Models\Event\event_userpayMethod;
use App\Models\Ticket\ticket;
use App\Models\Media\Media;
use Illuminate\Support\Facades\Storage;
use App\Models\Event\event_sitzplan;
use App\Models\Event\event_sitzplatz;
use App\Models\Event\event_sitzplatzstatus;

use App\Models\Event\event_tournament;
use App\Models\Event\event_tournament_type;
use App\Models\Event\event_tournament_player;
use App\Models\Event\event_tournament_matches;
use App\Models\Event\event_tournament_teams;
use App\Models\Games\games;

use App\Models\Articel\Articel;


use App\User;
use Auth;
use Session;


class ActiveEventController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function users($eventId)
	{
		$event = event::find($eventId);
		$users = event_users::where('event_id','=',$eventId)->get();
		foreach ($users as $user) {
			$user->user = User::find($user->user_id);
		}
		$allUsers = User::all();
		$tickets = ticket::where('event_id','=',$eventId)->get();
		$payments = event_userpayMethod::all();

		return view('backend.activeEvent.users', compact('event','users', 'tickets', 'payments','allUsers'));

	}

	public function addUser($eventId,Request $request)
	{
		$user = User::find($request->input('user_id'));

		$userInDb = event_users::where('user_id', $user->id)->where('event_id',$eventId)->first();


		//if user already Exists in DB
		if ($userInDb) {

			echo $userInDb;
		//User Exists
		//todo: ask if user should be changed or switch to edit mode with ID
			flash($user->username . ' is already registered for the Event, please change that one')->warning()->important();

			return redirect()->back();

		}

		$newUser =  new event_users();
		$newUser->event_id = $eventId;
		$newUser->user_id  = $request->input('user_id');
		$newUser->comment = $request->input('comment');

		if ($request->input('paid')) 
		{
			$newUser->paid  = 1;
			$newUser->ticket_id = $request->input('ticket_id');
			$newUser->payment_id = $request->input('payment_id');
			$newUser->pay_date =  date("Y-m-d H:i:s",strtotime($request->input('pay_date')));

		}		
		else
		{
			$newUser->paid = 0;
		}

		if ($request->input('arrived')) {
			$newUser->arrived = 1;
			$newUser->arrived_time = date("Y-m-d H:i:s",strtotime($request->input('arrived_time')));

		}
		else
		{
			$newUser->arrived = 0;
		}

		$newUser->save();

		flash($user->username . ' saved for Event')->success()->important();

		return redirect()->back();
	}

	public function deleteUser($eventId, $userId)
	{
		$event_user = event_users::where('user_id',$userId)->where('event_id',$eventId)->first();

		$event_user->delete();

		flash('User removed from Event')->error()->important();

		return back();
	}

	public function userPaidCash($eventId, $userId)
	{

		$user  = event_users::find($userId);
		$user->paid = 1;
		$user->payment_id = 1;
		$user->pay_date = date('Y-m-d H:i:s');

		$user->save();

		$realuser = User::find($user->user_id);

		flash($realuser->username . ' paid with Cash')->success()->important();

		return redirect()->back();
	}

	public function userPaidPaypal($eventId, $userId)
	{

		$user  = event_users::find($userId);
		$user->paid = 1;
		$user->payment_id = 2;
		$user->pay_date = date('Y-m-d H:i:s');

		$user->save();

		$realuser = User::find($user->user_id);

		flash($realuser->username . ' paid with Paypal')->success()->important();

		return redirect()->back();
	}

	public function userArrived($eventId,$userId)
	{
		$user  = event_users::find($userId);
		$user->arrived = 1;
		$user->arrived_time = date('Y-m-d H:i:s');

		$user->save();

		$realuser = User::find($user->user_id);

		flash($realuser->username . ' arrived')->success()->important();

		return redirect()->back();
	}

	public function seatplan($eventId)
	{
		$event = event::find($eventId);
		$seatplans =  event_sitzplan::where('event_id',$eventId)->get();

		foreach ($seatplans as $seatplan) 
		{
			$seatplan->seats =  event_sitzplatz::where('sitzplan_id',$seatplan->id)->get();

			foreach ($seatplan->seats as $seat) 
			{
				$seat->eventuser = event_users::find($seat->eventuser_id); 
				if ($seat->eventuser) 
				{
					$seat->eventuser->user = User::find($seat->eventuser->user_id); 
				}
				$seat->status = event_sitzplatzstatus::find($seat->status_id); 
			}
		}
		$sitzplatzStatus = event_sitzplatzstatus::all();
		$eventUsers = event_users::where('event_id',$eventId)->get();
		foreach ($eventUsers as $eventUser) {
			$eventUser->user = User::find($eventUser->user_id);
		}
		return view('backend.activeEvent.seatplan', compact('seatplans', 'event','eventUsers','sitzplatzStatus'));
	}

	public function saveSeat($eventId,Request $request)
	{

		$seat = event_sitzplatz::find($request->input('seat_id'));

		$seat->eventuser_id = $request->input('user');
		$seat->status_id = $request->input('status');
		$seat->save();
		flash($seat->name . ' changed and saved')->important();
		return redirect()->back();
	}


	public function freeSeat($eventId,$seatId,Request $request)
	{
		$seat = event_sitzplatz::find($seatId);

		$seat->eventuser_id = null;
		$seat->status_id = 1;
		$seat->save();
		flash($seat->name . ' is free now')->important();
		return redirect()->back();
	}

	public function tournaments($eventId)
	{
		$event = event::find($eventId);

		$tournaments = event_tournament::where('event_id',$eventId)->where('active',1)->get();
		foreach ($tournaments as $tournament) 
		{

			$tournament->game = games::find($tournament->games_id);
			$tournament->watcher1 = User::find($tournament->watcher1_id);
			$tournament->watcher2 = User::find($tournament->watcher2_id);
			$tournament->type = event_tournament_type::find($tournament->type_id);


			switch ($tournament->maxTeams) {
				case 2:
				$tournament->rounds = 1;
				break;
				case 4:
				$tournament->rounds = 2;
				break;
				case 8:
				$tournament->rounds = 3;
				break;
				case 16:
				$tournament->rounds = 4;
				break;
				case 32:
				$tournament->rounds = 5;
				break;
				case 64:
				$tournament->rounds = 6;
				break;
				case 128:
				$tournament->rounds = 7;
				break;
				default:
				$tournament->rounds = 0;
				break;
			}

			//Matches
			$tournament->matches = event_tournament_matches::where('tournament_id', $tournament->id)->get();
			foreach ($tournament->matches as $match) {
				if ($match->t1_id != NULL) {
					$match->t1_id = event_tournament_teams::find($match->t1_id);
				}
				if ($match->t2_id != NULL) {
					$match->t2_id = event_tournament_teams::find($match->t2_id);
				}
				if ($match->winner_id != NULL) {
					$match->winner_id = event_tournament_teams::find($match->winner_id);
				}
			}

			//teams
			$tournament->teams = event_tournament_teams::where('tournament_id',$tournament->id)->get();
			foreach ($tournament->teams as $team) {
				$team->players = event_tournament_player::where('team_id',$team->id)->get();
				foreach ($team->players as $player) {
					$player->eventUser = event_users::find($player->player_id);

					$player->User = User::find($player->eventUser->user_id);
				}
			}

		}
		$registerdTeams = event_tournament_teams::where('tournament_id',$tournament->id)->count();

		$eventUsers =  event_users::where('event_id', $tournament->event_id)->get();
		foreach ($eventUsers as $eventUser) {
			$eventUser->user = User::find($eventUser->user_id);
		}


		return view('backend.activeEvent.tournament', compact('event', 'tournaments', 'registerdTeams','eventUsers'));
	}

	public function startFirstRound($eventId, $tournamentId)
	{
		$tournament  = event_tournament::find($tournamentId);

		$matches = event_tournament_matches::where('tournament_id', $tournament->id)->get();
		

		foreach ($matches as $dMatches) 
		{
			$dMatches->t1_id = NULL;
			$dMatches->t2_id = NULL;
			$dMatches->winner_id  = NULL;
			$dMatches->score_t1 = 0;
			$dMatches->score_t2 = 0;
			$dMatches->save();

		}

		$allTeams =  event_tournament_teams::where('tournament_id',$tournamentId)->get();
		$a = [];

		foreach ($allTeams as $sTeam) {
			array_push($a,$sTeam->id);
		}
		shuffle($a);

		$matchesRoundOne =  event_tournament_matches::where('tournament_id',$tournamentId)->where('round',0)->get();

		foreach ($matchesRoundOne as $match) 
		{

			if (isset($a[0])) {
				$match->t1_id = $a[0];
				array_splice($a,0,1);
			}
			if (isset($a[0])) {
				$match->t2_id = $a[0];	
				array_splice($a,0,1);
			}



			if ($match->t1_id == null && $match->t2_id != NUll) {
				$match->winner_id = $match->t2_id;

				$allMatches = event_tournament_matches::where('tournament_id', $tournamentId)->get();
				foreach ($allMatches as $nextMatch) {
					if ($nextMatch->t1_pre != null && $nextMatch->t1_pre == $match->number) {
						$nextMatch->t1_id =  $match->winner_id;
						$nextMatch->save();
					}

					if ($nextMatch->t2_pre != null && $nextMatch->t2_pre == $match->number) {
						$nextMatch->t2_id =  $match->winner_id;
						$nextMatch->save();
					}

				}
			}
			if ($match->t2_id == null && $match->t1_id != NUll) {
				$match->winner_id = $match->t1_id;
				$allMatches = event_tournament_matches::where('tournament_id', $tournamentId)->get();

				foreach ($allMatches as $nextMatch) {
					if ($nextMatch->t1_pre != null && $nextMatch->t1_pre == $match->number) {
						$nextMatch->t1_id =  $match->winner_id;
						$nextMatch->save();
					}

					if ($nextMatch->t2_pre != null && $nextMatch->t2_pre == $match->number) {
						$nextMatch->t2_id =  $match->winner_id;
						$nextMatch->save();
					}

				}
			}

			$match->save();

		}

		return redirect()->back();
	}


	public function enterScores(Request $request)
	{
		$match = event_tournament_matches::find($request->input('matchId'));

		$match->score_t1 = $request->input('scoret1');
		$match->score_t2 = $request->input('scoret2');

		if($match->score_t1 > $match->score_t2)
		{	
			if ($match->t1_id == NULL) {
				flash('Fly cannot win')->error()->important();
				return redirect()->back();
			}
			$match->winner_id = $match->t1_id;


		}
		elseif($match->score_t1 < $match->score_t2)
		{
			if ($match->t2_id == NULL) {
				flash('Fly cannot win')->error()->important();
				return redirect()->back();
			}

			$match->winner_id = $match->t2_id;
		}
		else
		{
			flash('Draw is not ACCEPTABLE')->error()->important();
			return redirect()->back();
		}

		$match->save();


		$allMatches = event_tournament_matches::where('tournament_id', $match->tournament_id)->get();

		foreach ($allMatches as $nextMatch) {
			if ($nextMatch->t1_pre != null && $nextMatch->t1_pre == $match->number) {
				$nextMatch->t1_id =  $match->winner_id;
				$nextMatch->save();
			}

			if ($nextMatch->t2_pre != null && $nextMatch->t2_pre == $match->number) {
				$nextMatch->t2_id =  $match->winner_id;
				$nextMatch->save();
			}

		}


		flash('winner of the match: ' . $match->id . ' is ' . event_tournament_teams::find($match->winner_id)->name)->success()->important();

		return redirect()->back();

	}


	public function addTeams(Request $request,$eventId,$tournamentId)
	{
		$newTeam = new event_tournament_teams();

		$newTeam->tournament_id = $tournamentId;
		$newTeam->name = $request->input('teamName');
		$newTeam->win = 0;
		$newTeam->lose = 0;

		$newTeam->save();

		flash($newTeam->name . ' saved')->important();

		return redirect()->back();

	}

	public function arrival($eventId)
	{

		$event =  event::find($eventId);

		$arrive = Articel::find($event->arrive_id);

		return view('backend.activeEvent.arrive', compact('event', 'arrive'));

	}
}