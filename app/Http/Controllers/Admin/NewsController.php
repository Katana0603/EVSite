<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\User;
use App\Models\News\NewsComments;
use Auth;
use Session;

class NewsController extends Controller
{
	//

	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$news = News::all();

		return view('backend.news.index', compact('news'));
	}


	public function create(){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$creationUser = User::permission('News-Admin')->get();


		$news = News::all();
		return view('backend.news.create', compact('news','creationUser'));
	}

	public function store(Request $request){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		
		// Validator
		$news = new News();

		$news->title =  $request->input('title');
		$news->content = $request->input('content');
		$news->user_id =  $request->input('userSelect');
		if ($request->input('statusCheck') !== null) {
			$news->status = 1;
		} else {
			$news->status = 0;
		}

		if ($request->input('commentsCheck') !== null) {
			$news->comments = 1;
		} else {
			$news->comments = 0;
		}

		$news->orderNumber = $request->input('orderNumber');


		$news->release_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));

		$news->close_time    = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		

		$news->save();

		flash('successful stored')->success()->important();

		return redirect()->route('admin.news.index');
	}


	public function edit($id){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$news = News::find($id);

		$news->user =  User::find($news->user_id);

		return view('backend.news.edit', compact('news'));
	}

	public function update($id, Request $request){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		$oldNews =  News::find($id);

		$oldNews->title =  $request->input('title');
		$oldNews->content = $request->input('content');
		$oldNews->user_id =  $oldNews->user_id;
		if ($request->input('statusCheck') !== null) {
			$oldNews->status = 1;
		} else {
			$oldNews->status = 0;
		}

		if ($request->input('commentsCheck') !== null) {
			$oldNews->comments = 1;
		} else {
			$oldNews->comments = 0;
		}

		$oldNews->orderNumber = $request->input('orderNumber');


		$oldNews->release_time = date("Y-m-d H:i:s",strtotime($request->input('start_datetime')));

		$oldNews->close_time    = date("Y-m-d H:i:s",strtotime($request->input('end_datetime')));
		


		$oldNews->save();

		flash('successful updated', $oldNews->title)->success()->important();

		return redirect()->route('admin.news.index');
	}



	public function delete($id){
		if (!Auth::user()->hasPermissionTo('News-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$news = News::find($id);

		$news->delete();

		flash('successful deleted', $news->title)->warning()->important();

		return redirect()->back();
	}

	public function like($id){
		$news =  News::find($id);

		$news->increment('likes');


		flash('You liked it!')->success()->important();
		return redirect()->back();
	}

	public function dislike($id){
		$news =  News::find($id);

		$news->increment('dislikes');


		flash('You disliked it!')->warning()->important();
		return redirect()->back();
	}
}
