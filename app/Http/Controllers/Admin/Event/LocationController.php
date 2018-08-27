<?php

namespace App\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event\event_location;
use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
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
		$locations = event_location::all();

		return view('backend.event.location.index', compact('locations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('backend.event.location.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$location = new event_location();
		$location->name = $request->input('name');
		$location->waydescription = $request->input('waydescription');
		$location->description = $request->input('description');
		$location->street = $request->input('street');
		$location->city = $request->input('city');
		$location->zip = $request->input('zip');
		$location->country = $request->input('country');
		$location->longitude = $request->input('longitude');
		$location->latitude = $request->input('latitude');

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $location->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'. $filename);


			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$location->media_path = 'event/location/' . $location->name .'/'. 'map/'. $filename;

		}

		$location->save();

		flash($location->name .' successfull saved')->success()->important();
		return redirect()->route('eventlocation.index');
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
		$location = event_location::find($id);

		return view('backend.event.location.edit', compact('location'));
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
		$location  = event_location::find($id);
		$location->name = $request->input('name');
		$location->waydescription = $request->input('waydescription');
		$location->description = $request->input('description');
		$location->street = $request->input('street');
		$location->city = $request->input('city');
		$location->zip = $request->input('zip');
		$location->country = $request->input('country');
		$location->longitude = $request->input('longitude');
		$location->latitude = $request->input('latitude');

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $location->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/location/' . $location->name .'/'. 'map/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$location->media_path = 'event/location/' . $location->name .'/'. 'map/'. $filename;

		}



		$location->save();

		flash($location->name . ' successful updated')->success()->important();

		return redirect()->route('eventlocation.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$location = event_location::find($id);

		$location->delete();

		flash( $location->name . ' deleted')->error()->important();

		return redirect()->back();
	}
}
