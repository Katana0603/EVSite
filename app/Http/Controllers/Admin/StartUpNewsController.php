<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\StartUpNews\startUpNews;

class StartUpNewsController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){

		$startUpNews =  startUpNews::first();

		return view('backend.startUpNews.index', compact('startUpNews'));
	}

	public function store( Request $request){

		// $newStartUpNews = startUpNews::firstOrNew('id', $id);
		startUpNews::truncate();

		$newStartUpNews = new startUpNews();

		$newStartUpNews->text = $request->input('text');

		$newStartUpNews->save();

		return redirect()->back();
	}




}
