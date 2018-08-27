<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event;
use App\Models\Event\event_sponsors;

use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class SponsorController extends Controller
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

		$sponsors = event_sponsors::all();
		foreach ($sponsors as $sponsor) {
			$sponsor->event = event::find($sponsor->event_id);
		}

		return view('backend.event.sponsoren.index', compact('sponsors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$events = event::all();

		return view('backend.event.sponsoren.create', compact('events'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$sponsor = new event_sponsors();
		$sponsor->name =  $request->input('name');
		$sponsor->homepage = $request->input('homepage');
		$sponsor->text =  $request->input('text');
		$sponsor->email = $request->input('email');
		$sponsor->event_id = $request->input('event');
		// TODO: Media


		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $sponsor->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$sponsor->media_path = 'sponsor/' . $sponsor->name .'/'. $filename;
		}

		$sponsor->save();
		flash($sponsor->name . ' wurde erfolgreich angelegt')->important()->success();#
		return redirect()->route('eventsponsoren.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{       

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$events = event::all();
		$sponsor = event_sponsors::find($id);
		$sponsor->event = event::find($sponsor->event_id);

		return view('backend.event.sponsoren.edit', compact('events','sponsor'));
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
		$sponsor = event_sponsors::find($id);
		$sponsor->name =  $request->input('name');
		$sponsor->homepage = $request->input('homepage');
		$sponsor->text =  $request->input('text');
		$sponsor->email = $request->input('email');
		$sponsor->event_id = $request->input('event');
		// TODO: Media
		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $sponsor->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'sponsor/' . $sponsor->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$sponsor->media_path = 'sponsor/' . $sponsor->name .'/'. $filename;
		}

		$sponsor->save();
		flash($sponsor->name . ' wurde erfolgreich geupdated')->important()->success();#
		return redirect()->route('eventsponsoren.index');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$sponsor = event_sponsors::find($id);

		$sponsor->delete();

		flash( $sponsor->name . ' deleted')->error()->important();

		return redirect()->back();
	}
}
