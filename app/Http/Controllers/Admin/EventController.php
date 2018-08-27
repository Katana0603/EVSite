<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_location;
use App\Models\Event\event_prices;
use App\Models\Event\event_users;
use App\Models\Event\event_user_status;
use App\Models\Event\event_userpayMethod;
use App\Models\Media\Media;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class EventController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index()
	{

		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$chooseEvent = event::all();
		$events = event::where('intern','=',0)->get();
		$internEvents = event::where('intern','=',1)->get();

		return view('backend.event.index', compact('events','internEvents','chooseEvent'));
	}

	public function create()
	{
		
		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$locations = event_location::all();

		return view('backend.event.create.general', compact('locations'));

	}


	public function store(Request $request)
	{

		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$file = $request->file('inputFile');
		$event = new event();

		$media = new Media();


		$event->author_id = Auth()->user()->id;
		$event->name = $request->input('name');
		if ($request->input('active') !== null) {
			$event->active = 1;
		} else {
			$event->active = 0;
		}
		if ($request->input('intern') !== null) {
			$event->intern = 1;
		} else {
			$event->intern = 0;
		}

		$event->allowedUser = $request->input('maxUser');
		$event->event_start = date("Y-m-d H:i:s",strtotime($request->input('start_eventdatetime')));
		$event->event_end = date("Y-m-d H:i:s",strtotime($request->input('end_eventdatetime')));
		$event->signup_start = date("Y-m-d H:i:s",strtotime($request->input('start_signupdatetime')));
		$event->signup_end = date("Y-m-d H:i:s",strtotime($request->input('end_signupdatetime')));
		$event->seatReserve_start = date("Y-m-d H:i:s",strtotime($request->input('start_seatplandatetime')));
		$event->seatReserve_end = date("Y-m-d H:i:s",strtotime($request->input('end_seatplandatetime')));
		$event->location_id =  $request->input('location');


		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $event->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'. $filename);



			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$event->media_path = 'event/logo/' . $event->name .'/'. 'map/'. $filename;

		}



		$event->save();

		flash('Event: ' . $event->name . ' saved')->important();

		return redirect()->route('admin.event.index');
	}

	public function edit($id)
	{
		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$locations = event_location::all();

		$event = event::find($id);
		$event->location = event_location::find($event->location_id);
		$media = Media::find($event->media_id);
		if (isset($media)) {
			$event->media =  Storage::disk('downloads')->get('event/logo/'.$media->name);
		}
		return view('backend.event.create.edit', compact('locations','event'));
	}

	public function update($id, Request $request)
	{

		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$event = event::find($id);


		$event->author_id = Auth()->user()->id;
		$event->name = $request->input('name');
		if ($request->input('active') !== null) {
			$event->active = 1;
		} else {
			$event->active = 0;
		}
		if ($request->input('intern') !== null) {
			$event->intern = 1;
		} else {
			$event->intern = 0;
		}

		$event->allowedUser = $request->input('maxUser');
		$event->event_start = date("Y-m-d H:i:s",strtotime($request->input('start_eventdatetime')));
		$event->event_end = date("Y-m-d H:i:s",strtotime($request->input('end_eventdatetime')));
		$event->signup_start = date("Y-m-d H:i:s",strtotime($request->input('start_signupdatetime')));
		$event->signup_end = date("Y-m-d H:i:s",strtotime($request->input('end_signupdatetime')));
		$event->seatReserve_start = date("Y-m-d H:i:s",strtotime($request->input('start_seatplandatetime')));
		$event->seatReserve_end = date("Y-m-d H:i:s",strtotime($request->input('end_seatplandatetime')));
		$event->location_id =  $request->input('location');




		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $event->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/logo/' . $event->name .'/'. 'map/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$event->media_path = 'event/logo/' . $event->name .'/'. 'map/'. $filename;

		}


		$event->save();

		flash('successful updated', $event->name)->success()->important();

		return redirect()->route('admin.event.index');

	}


	public function delete($id)
	{
		if (!Auth::user()->hasPermissionTo('Event-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$event = event::find($id);
		$event->delete();
		flash('successful deleted', $event->name)->warning()->important();

		return redirect()->back();
	}

	public function accountCheck(Request $request,$id){
		$event = event::find($id);

		$event->lastAccountCheck = date('Y-m-d H:i:s');
		$event->save();
		flash('Check hinterlegt')->important();
		return redirect()->route('admin.event.index');
	}

}
