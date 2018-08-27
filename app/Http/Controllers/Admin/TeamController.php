<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use App\Models\Team\Team;
use App\Models\Team\Team_Categories;
use App\User;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
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
		$teamCategories = Team_Categories::all();
		foreach ($teamCategories as $teamcat) {
			$teamcat->team = Team::where('teamCat_id','=',$teamcat->id)->get();
			foreach ($teamcat->team as $team) {
				$team->user =  User::find($team->user_id);
			}
		}
		$users = User::all();

		return view('backend.team.index', compact('teamCategories','users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{

		$team =  new Team();

		$team->user_id = $request->input('user_id');
		$team->teamCat_id = $request->input('cat_id');
		$team->function =  $request->input('function');
		$team->description =  $request->input('description');
		$team->orderNumber =  0;

		$team->save();

		flash('User added to Team')->important();

		return back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$team = Team::find($id)->delete();

		flash('Teammmember deleted deleted')->error()->important();

		return back();
	}

	public function storeTeamCat(Request $request)
	{
		$cat = new Team_Categories();
		$cat->name = $request->input('name');
		$cat->description = $request->input('description');
		$cat->save();

		flash('Categorie' . $cat->name . ' successfull saved')->success()->important();

		return back();
	}

	public function destroyTeamCat($id)
	{
		$teamCat = Team_Categories::find($id);

		Team::where('teamCat_id','=',$id)->delete();
		$teamCat->delete();

		flash($teamCat->name . ' deleted')->error()->important();

		return back();
	}
}
