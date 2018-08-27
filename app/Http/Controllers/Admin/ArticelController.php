<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articel\Articel;
use App\User;
use App\Models\Articel\articelComments;
use Auth;
use Session;

class ArticelController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$articel = Articel::all();

		return view('backend.articel.index', compact('articel'));
	}


	public function create(){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$articel = Articel::all();


		$creationUser = User::permission('Articel-Admin')->get();
		return view('backend.articel.create', compact('articel', 'creationUser'));
	}

	public function store(Request $request){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		// Validator



		$articel = new Articel();

		$articel->title =  $request->input('title');
		$articel->content = $request->input('content');
		$articel->author_id =  $request->input('userSelect');
		if ($request->input('statusCheck') !== null) {
			$articel->active = 1;
		} else {
			$articel->active = 0;
		}

		if ($request->input('commentsCheck') !== null) {
			$articel->commentary = 1;
		} else {
			$articel->commentary = 0;
		}

		$articel->orderNumber = $request->input('orderNumber');


		$articel->hits =  0;
		$articel->likes =  0;
		$articel->dislikes =  0;

		$articel->release_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));



		$articel->save();

		flash('successful stored')->success()->important();

		return redirect()->route('admin.articel.index');
	}


	public function edit($id){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$articel = Articel::find($id);

		$articel->user =  User::find($articel->author_id);

		return view('backend.articel.edit', compact('articel'));
	}

	public function update($id, Request $request){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$oldarticel =  Articel::find($id);

		$oldarticel->title =  $request->input('title');
		$oldarticel->content = $request->input('content');
		$oldarticel->author_id =  $oldarticel->author_id;
		if ($request->input('statusCheck') !== null) {
			$oldarticel->active = 1;
		} else {
			$oldarticel->active = 0;
		}

		if ($request->input('commentsCheck') !== null) {
			$oldarticel->commentary = 1;
		} else {
			$oldarticel->commentary = 0;
		}

		$oldarticel->orderNumber = $request->input('orderNumber');

		$oldarticel->release_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));

		$oldarticel->save();

		flash('successful updated', $oldarticel->title)->success()->important();

		return redirect()->route('admin.articel.index');
	}



	public function delete($id){
		if (!Auth::user()->hasPermissionTo('Articel-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$articel = Articel::find($id);

		$articel->delete();

		flash('successful deleted', $articel->title)->warning()->important();

		return redirect()->back();
	}


}
