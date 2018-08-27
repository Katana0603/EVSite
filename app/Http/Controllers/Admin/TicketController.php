<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;use App\Models\Event\event;
use App\Models\Event\event_location;
use App\Models\Event\event_prices;
use App\Models\Event\event_users;
use App\Models\Event\event_user_status;
use App\Models\Event\event_userpayMethod;
use App\Models\Media\Media;
use App\Models\Ticket\ticket;
use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class TicketController extends Controller
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
		$tickets =  ticket::all();

		return view('backend.event.ticket.index', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$events = event::all();
		return view('backend.event.ticket.create', compact('events'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$ticket = new ticket();

		$ticket->name = $request->input('name');
		$ticket->description = $request->input('description');
		$ticket->prices = $request->input('price');
		$ticket->event_id = $request->input('event');
		$ticket->start_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));
		$ticket->end_time = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		echo($ticket);

		if ($request->input('optionsRadios') == 1) 
		{

			if ($request->file('background-graphic')) 
			{
				$image = $request->file('background-graphic');
				$filename = $ticket->name . '.' . $image->getClientOriginalExtension();
				$path = 'storage/media/event/ticket/'.$ticket->name.'/';

				if (!File::exists(public_path($path))) {

					File::makeDirectory(public_path($path),0755,true);
				}
				$path = public_path($path . $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

				$ticket->backgroundgraphic = 'event/ticket/' . $ticket->name . '/' . $filename;
			}

			$ticket->save();
			flash('Ticket saved')->success()->important();

			return redirect()->route('admin.eventTickets.index');
		}
		else
		{

			if ($request->file('background-graphic')) 
			{
				$image = $request->file('background-graphic');
				$filename = $ticket->name . '.' . $image->getClientOriginalExtension();
				$path = 'storage/media/event/ticket/'.$ticket->name.'/';

				if (!File::exists(public_path($path))) {

					File::makeDirectory(public_path($path),0755,true);
				}
				$path = public_path($path . $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

				$ticket->uploadedTicketImage = 'event/ticket/' . $ticket->name . '/' . $filename;
			}

			$ticket->save();
			flash('Ticket saved')->success()->important();

			return redirect()->route('admin.eventTickets.index');
		}



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
		//

		$ticket = ticket::find($id);
		$ticket->event =  event::find($ticket->event_id);
		$events = event::all();

		return view('backend.event.ticket.edit', compact('ticket','events'));
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
		$ticket = ticket::find($id);

		$ticket->name = $request->input('name');
		$ticket->description = $request->input('description');
		$ticket->prices = $request->input('price');
		$ticket->event_id = $request->input('event');
		$ticket->start_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));
		$ticket->end_time = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		echo($ticket);

		if ($request->input('optionsRadios') == 1) 
		{

			if ($request->file('background-graphic')) 
			{
				$image = $request->file('background-graphic');
				$filename = $ticket->name . '.' . $image->getClientOriginalExtension();
				$path = 'storage/media/event/ticket/'.$ticket->name.'/';

				if (!File::exists(public_path($path))) {

					File::makeDirectory(public_path($path),0755,true);
				}
				$path = public_path($path . $filename);

				Image::make($image)->save($path);

				$ticket->backgroundgraphic = 'event/ticket/' . $ticket->name . '/' . $filename;
			}

			$ticket->save();
			flash('Ticket saved')->success()->important();

			return redirect()->route('admin.eventTickets.index');
		}
		else
		{
			if ($request->file('background-graphic')) 
			{
				$image = $request->file('background-graphic');
				$filename = $ticket->name . '.' . $image->getClientOriginalExtension();
				$path = 'storage/media/event/ticket/'.$ticket->name.'/';

				if (!File::exists(public_path($path))) {

					File::makeDirectory(public_path($path),0755,true);
				}
				$path = public_path($path . $filename);

				Image::make($image)->save($path);

				$ticket->uploadedTicketImage = 'event/ticket/' . $ticket->name . '/' . $filename;
			}

			$ticket->save();
			flash('Ticket saved')->success()->important();

			return redirect()->route('admin.eventTickets.index');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$ticket = ticket::find($id);

		$ticket->delete();

		flash($ticket->name. ' deleted')->error()->important();

		return back();

	}
}
