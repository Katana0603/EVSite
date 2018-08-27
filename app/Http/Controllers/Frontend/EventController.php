<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_location;
use App\Models\Event\event_userpayMethod;
use App\Models\Event\event_user_status;
use App\Models\Event\event_users;
use App\Models\Ticket\ticket;
use App\Models\Event\event_sitzplan;
use App\Models\Event\event_sitzplatz;
use App\Models\Event\event_sitzplatzstatus;

use App\Models\Event\event_tournament;
use App\Models\Games\games;

use App\User;
use App\Models\User\Clan;
use Auth;
use Session;

class EventController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except('index','tickets','tournaments','seatplan','user', 'faq');
	}

	public function index(){

		if (Auth::check()) {
			if (Auth::user()->can('Event-Intern')) {

				$event = event::where('active','=',1)->get();
			}
			else
			{
				$event =  event::where('active', 1)->where('intern', 0)->get();
			}
		}
		else
		{
			$event =  event::where('active', 1)->where('intern', 0)->get();
		}

		foreach ($event as $singleEvent) {
			$singleEvent->location =  event_location::where('id','=',$singleEvent->location_id)->get();
			$singleEvent->count_users =  event_users::count();
			$singleEvent->tickets = ticket::where('event_id',$singleEvent->id)->get();

			if (Auth::check()) {
				
				$singleEvent->userRegisterd =  event_users::where('event_id', $singleEvent->id)->where('user_id', Auth::user()->id)->first();
			}
			
		}

		return view('frontend.event.general')->with('event',$event);

	}


	public function tickets()
	{
		$event = event::where('active','=',1)->get();

		foreach ($event as $singleEvent) {
			$singleEvent->location =  event_location::where('id','=',$singleEvent->location_id)->get();
			$singleEvent->count_users =  event_users::count();
			$singleEvent->tickets = ticket::where('event_id',$singleEvent->id)->where('active',1)->get();
		}

		return view('frontend.event.tickets', compact('event'));
	}


	public function tournaments()
	{
		$event = event::where('active', 1)->get();

		foreach ($event as $singleEvent) {
			$singleEvent->tournaments =  event_tournament::where('event_id',$singleEvent->id)->where('active',1)->get();
			foreach ($singleEvent->tournaments as $tournament) {
				$tournament->game =  games::find($tournament->games_id);
			}

		}

		return view('frontend.event.tournament')->with('event',$event);
	}

	public function seatplan(){



		$sitzplatzStatus = event_sitzplatzstatus::all();
		$event = event::where('active','=',1)->get();

		foreach ($event as $singleEvent) {
			$singleEvent->seatplan = event_sitzplan::where('event_id',$singleEvent->id)->where('active',1)->get();
			foreach ($singleEvent->seatplan as $seatplan) {
				$seatplan->seats = event_sitzplatz::where('sitzplan_id',$seatplan->id)->get();
				foreach ($seatplan->seats as $seat) {
					$seat->status = event_sitzplatzstatus::find($seat->status_id);
					if ($seat->eventuser_id) {
						$seat->eventuser = event_users::find($seat->eventuser_id);
					}
				}
			}
		}
		return view('frontend.event.seatplan', compact('event','sitzplatzStatus'));
	}

	public function reserveSeat($id)
	{
		$seat = event_sitzplatz::find($id);

		$seat->status_id =  event_sitzplatzstatus::where('name', 'reserviert')->first();
		$seat->eventuser_id = event_users::where('user_id', Auth::user()->id)->first();

		echo "$seat";
		// $seat->save();



	}

	public function checkSeat($id)
	{
		$seat = event_sitzplatz::find($id);

	}

	public function releaseSeat($id)
	{
		$seat = event_sitzplatz::find($id);

	}

	public function registerNow($id)
	{

		$event = event::find($id);

		$user = Auth::user();

		$alreadyEventUser = event_users::where('user_id',$user->id)->where('event_id',$event->id)->first();

		if (!$alreadyEventUser) {

			$eventUser = new event_users();

			$eventUser->event_id = $event->id;
			$eventUser->user_id = $user->id;


			$eventUser->save();

			flash('You`ve been registered')->success()->important();
			return redirect()->back();
		}
		else
		{
			flash('You are already registered')->important();

			return redirect()->back();
		}

	}


	public function user()
	{
		$event = event::where('active','=',1)->get();

		foreach ($event as $sin) {
			$sin->users = event_users::where('event_id',$sin->id)->get();
			foreach ($sin->users as $eUser) {
				$eUser->user =  User::find($eUser->user_id);
				$eUser->user->clan = Clan::find($eUser->user->clan_id);
				$eUser->payment = event_userpayMethod::find($eUser->payment_id);


				//Status
				//if not Paid then angemeldet

				if ($eUser->paid == null || $eUser->paid == 0) {
					$eUser->status = 'angemeldet';
				}
				else
				{
					$eUser->status = 'bezahlt';
				}

				//Sitzplatz
				$sitzplan = event_sitzplan::where('event_id',$sin->id)->get();
				if ($sitzplan) {

					foreach ($sitzplan as $sSeatplan) {
						$sSeatplan->seats = event_sitzplatz::where('sitzplan_id',$sSeatplan->id)->get();


						foreach ($sSeatplan->seats as $seat) {
							if ($seat->eventuser_id == $eUser->id) {
								$eUser->seat = $seat;
							}
						}
					}

				}


			}
		}

		return view('frontend.event.users', compact('event'));
	}

	public function arrival()
	{
		$event = event::where('active','=',1)->get();

		return view('frontend.event.arrival', compact('event'));

	}

	public function faq()
	{
		$event = event::where('active','=',1)->get();

		return view('frontend.event.faq', compact('event'));

	}
}
