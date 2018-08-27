<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Storage;
use App\Models\Partner\Partner;
use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
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
		$partners =  Partner::all();

		return view('backend.partner.index', compact('partners'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('backend.partner.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$partner  = new Partner();

		$partner->name = $request->input('name');
		$partner->description = $request->input('description');
		$partner->website = $request->input('website');
		$partner->activ = 1;

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $partner->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'partner/' . $partner->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'partner/' . $partner->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'partner/' . $partner->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$partner->media_path = 'partner/' . $partner->name .'/'. $filename;
		}

		$partner->save();

		flash($partner->name .' successfull saved')->success()->important();
		return redirect()->route('partner.index');
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
		$partner = Partner::find($id);

		return view('backend.partner.edit', compact('partner'));
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
		$partner  = Partner::find($id);

		$partner->name = $request->input('name');
		$partner->description = $request->input('description');
		$partner->website = $request->input('website');

		if ($request->input('activ') !== null) 
		{			
			$partner->activ = 1;
		}
		else
		{
			$partner->activ = 0;			
		}

		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $partner->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'partner/' . $partner->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'partner/' . $partner->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'partner/' . $partner->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$partner->media_path = 'partner/' . $partner->name .'/'. $filename;
		}

		$partner->save();

		flash($partner->name .' successfull saved')->success()->important();
		return redirect()->route('partner.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{

		$partner = Partner::find($id);

		$partner->delete();

		flash( $partner->name . ' deleted')->error()->important();

		return redirect()->back();
		//
	}
}
