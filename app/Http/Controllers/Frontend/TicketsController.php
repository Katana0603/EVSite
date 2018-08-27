<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_location;
use App\Models\Event\event_user_payMethod;
use App\Models\Event\event_user_status;
use App\Models\Event\event_users;
use App\Models\Event\event_tickets;
use App\Models\Event\event_t_c;
use App\Models\Event\event_ticketcontent;

class TicketsController extends Controller
{
	
	public function index(){

		$events = event::where('active','=',1)->get();

		foreach ($events as $singleEvent) {
			$singleEvent->location =  event_location::where('id','=',$singleEvent->location_id)->get();
			$singleEvent->count_users =  event_users::count();
			
			// get tickets where Event Id
			$singleEvent->tickets = event_tickets::where('event_id','=', $singleEvent->id)->where('active','=',1)->get();
			// für alle tickets bekomme ein einzelenes ticket
			foreach ($singleEvent->tickets as $ticket) {
			// bekomme ein ticket wo die ticket id  = t_id(verknüpfungstabelle is)
				$tc = event_t_c::where('t_id','=',$ticket->id)->get();
				
				$ticket->content = array();
				foreach ($tc as $tmp) {
					$content =  event_ticketcontent::where('id' ,'=',$tmp->c_id)->get();
					$ticket->content = array_merge($ticket->content , [$content]);
				}
			}
		}
		return view('frontend.tickets.index')->with('events',$events);
	}

}
