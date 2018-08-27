<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Event\event;
use App\Models\Event\event_sitzplan;
use App\Models\Event\event_sitzplatz;
use App\Models\Event\event_sitzplatzstatus;

use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class SeatplanController extends Controller
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

		$seatplans =  event_sitzplan::all();
		foreach ($seatplans as $seatplan) {
			$seatplan->event = event::find($seatplan->event_id);
		}
		return view('backend.event.seatplan.index', compact('seatplans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$events =  event::all();

		return view('backend.event.seatplan.create', compact('events'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$seatplan = new event_sitzplan();

		$seatplan->name = $request->input('name');
		if ($request->input('active') !== null) 
		{
			$seatplan->active =  1;
		}
		else
		{
			$seatplan->active = 0;
		}
		
		$seatplan->event_id =  $request->input('event');

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $seatplan->name . '.' . $image->getClientOriginalExtension();
			$path = 'storage/media/event/seatplan/'.$seatplan->name.'/';

			if (!File::exists(public_path($path))) {

				File::makeDirectory(public_path($path),0755,true);
			}
			$path = public_path($path . $filename);

			Image::make($image)->resize(1000,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$seatplan->media_path = 'event/seatplan/' . $seatplan->name . '/' . $filename;
		}
		$seatplan->save();
		flash('seatplan: ' . $seatplan->name . ' is saved')->success()->important();
		return redirect()->route('eventSeatplan.index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$seatplan =  event_sitzplan::find($id);
		$seatplan->event = event::find($seatplan->event_id);
		$events =  event::all();
		return view('backend.event.seatplan.edit', compact('events', 'seatplan'));	
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
		$seatplan = event_sitzplan::find($id);

		$seatplan->name = $request->input('name');
		if ($request->input('active') !== null) 
		{
			$seatplan->active =  1;
		}
		else
		{
			$seatplan->active = 0;
		}
		
		$seatplan->event_id =  $request->input('event');

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $seatplan->name . '.' . $image->getClientOriginalExtension();
			$path = 'storage/media/event/seatplan/'.$seatplan->name.'/';

			if (!File::exists(public_path($path))) {

				File::makeDirectory(public_path($path),0755,true);
			}
			$path = public_path($path . $filename);

			Image::make($image)->resize(1000,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$seatplan->media_path = 'event/seatplan/' . $seatplan->name . '/' . $filename;

		}

		$seatplan->save();

		flash('seatplan: ' . $seatplan->name . ' is saved')->success()->important();

		return redirect()->route('eventSeatplan.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//

		$seatplan = event_sitzplan::find($id);

		$seatplan->delete();

		flash($seatplan->name . 'deleted')->error()->important();

		return back();
	}

	public function setSeatsOnPlan($id)
	{
		$seatplan =  event_sitzplan::find($id);

		$seatplan->seats =  event_sitzplatz::where('sitzplan_id','=',$seatplan->id)->get();
		$event  = event::find($seatplan->event_id);
		return view('backend.event.seatplan.setSeats', compact('seatplan', 'event'));

	}

	public function storeNewSeat(Request $request)
	{
		$seatplan = event_sitzplan::find($request->input('seatplan_id'));

		$seat =  new event_sitzplatz();

		$seat->sitzplatzNr = event_sitzplatz::where('sitzplan_id','=',$seatplan->id)->count() + 1;
		$seat->name = $seat->sitzplatzNr;
		$seat->x = $request->input('x');
		$seat->y = $request->input('y');
		$seat->sitzplan_id  = $seatplan->id;
		$seat->status_id = 1;

		$seat->save();

		flash('Seat: ' . $seat->name . ' saved!')->success()->important();

		return back();
	}


	public function editNewSeat(Request $request)
	{
		
		$seat = event_sitzplatz::find($request->input('seat_id'));
		$seat->name = $request->input('name');
		$seat->save();

		flash($seat->name . ' edited')->info()->important();

		return redirect()->back();
		
	}
	public function deleteNewSeat(Request $request)
	{
		$id =  $request->input('deleteSeatNr');
		$seat =  event_sitzplatz::find($id);
		$seat->delete();
		flash($seat->name .  ' deleted!')->error()->important();

		return redirect()->back();
	}
}
