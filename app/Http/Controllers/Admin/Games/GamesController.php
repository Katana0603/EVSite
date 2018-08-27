<?php

namespace App\Http\Controllers\Admin\Games;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Games\games;


use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class GamesController extends Controller
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
		$games = games::all();

		return view('backend.games.index', compact('games'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		
		return view('backend.games.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$game =  new games();
		$game->name = $request->input('name');
		$game->description =  $request->input('description');


		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $game->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/games/' . $game->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/games/' . $game->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/games/' . $game->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$game->media_path = 'event/games/' . $game->name .'/'. $filename;

		}


		$game->save();

		flash($game->name . 'successful saved')->success()->important();
		return redirect()->route('eventGames.index');
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
		$game =  games::find($id);
		return view('backend.games.edit', compact('game'));
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
		$game =  games::find($id);
		$game->name = $request->input('name');
		$game->description =  $request->input('description');


		if ($request->file('inputFile')) 
		{
			$image = $request->file('inputFile');
			$filename = $game->name . '.' . $image->getClientOriginalExtension();

			if (!File::exists(public_path('storage/media/' . 'event/games/' . $game->name .'/'))) {

				File::makeDirectory(public_path('storage/media/' . 'event/games/' . $game->name .'/'),0755,true);
			}
			$path = public_path('storage/media/' . 'event/games/' . $game->name .'/'. $filename);

			Image::make($image)->resize(500,null, function($constraint){$constraint->aspectRatio();})->save($path);

			$game->media_path = 'event/games/' . $game->name .'/'. $filename;

		}


		$game->save();

		flash($game->name . 'successful saved')->success()->important();
		return redirect()->route('eventGames.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$game = games::find($id);
		$game->delete();
		flash($game->name . ' deleted');

		return back();
	}
}
