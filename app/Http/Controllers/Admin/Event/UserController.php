<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event_users;
use App\Models\Event\event;
use App\Models\Event\event_userpayMethod;
use App\Models\Ticket\ticket;
use App\User;
use Auth;
use Session;
use App\Models\User\Clan;

class UserController extends Controller
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
		$eventusers = event_users::all();

		foreach ($eventusers as $eventuser) {
			$eventuser->event = event::find($eventuser->event_id);
			$eventuser->user = User::find($eventuser->user_id);
		}

		return view('backend.event.users.index', compact('eventusers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$events = event::all();
		$users = User::all();
		$payments = event_userpayMethod::all();
		$tickets = ticket::all();
		return view('backend.event.users.create', compact('events','users','payments','tickets'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// prüfen ob User bereits vorhanden
		$user = event_users::where('user_id','=',$request->input('user_id'))->where('event_id','=',$request->input('event_id'))->get();

		if ($user->count()) {

			flash('User already registerd for Event')->important();

			return redirect()->back();
		}

		$eventuser = new event_users();

		$eventuser->event_id = $request->input('event_id');
		$eventuser->user_id = $request->input('user_id');
		$eventuser->payment_id = $request->input('payment_id');
		$eventuser->pay_date = date("Y-m-d H:i:s",strtotime($request->input('pay_date')));
		$eventuser->ticket_id = $request->input('ticket_id');
		$eventuser->arrived = $request->input('arrived');
		if ($request->input('paid') !== null) {
			$eventuser->paid = 1;
		} else {
			$eventuser->paid = 0;
		}
		
		$eventuser->comment = $request->input('comment');




		$eventuser->save();

		flash('User added to Event')->success()->important();

		return redirect()->route('eventuser.index');
	}

	public function storeClan(Request $request){
		$clan = new Clan();

		$clan->name = $request->input('clan_name');

		$clan->save();

		flash( $clan->name . ' saved')->important();
		return back()->withInput();

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
		$eventuser =  event_users::find($id);
		$eventuser->user = User::find($eventuser->user_id);
		$eventuser->event = event::find($eventuser->event_id);
		$eventuser->ticket =  ticket::find($eventuser->ticket_id);
		$eventuser->payment = event_userpayMethod::find($eventuser->payment_id);
		$events = event::all();
		$users = User::all();
		$payments = event_userpayMethod::all();
		$tickets = ticket::all();

		return view('backend.event.users.edit', compact('eventuser','events','users','payments','tickets'));
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
		// prüfen ob User bereits vorhanden
		$user = event_users::where('user_id','=',$request->input('user_id'))->where('event_id','=',$request->input('event_id'))->get();

		if ($user->count()) {

			flash('User already registerd for Event')->important();

			return redirect()->back();
		}

		$eventuser = event_users::find($id);

		$eventuser->event_id = $request->input('event_id');
		$eventuser->user_id;
		$eventuser->payment_id = $request->input('payment_id');
		$eventuser->pay_date = date("Y-m-d H:i:s",strtotime($request->input('pay_date')));
		$eventuser->ticket_id = $request->input('ticket_id');
		$eventuser->arrived = $request->input('arrived');
		if ($request->input('paid') !== null) {
			$eventuser->paid = 1;
		} else {
			$eventuser->paid = 0;
		}

		$eventuser->comment = $request->input('comment');
		$eventuser->save();
		flash('User updated')->success()->important();

		return redirect()->route('eventuser.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$eventuser =  event_users::find($id);

		$eventuser->delete();

		flash('User removed from Event')->error()->important();
		return redirect()->back();
	}
}
