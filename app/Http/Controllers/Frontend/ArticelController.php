<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articel\Articel;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Articel\ArticelComments;
use Lang;


class ArticelController extends Controller
{


	public function index(){
		$articel = Articel::where('active', '=','1')->orderby('orderNumber')->orderby('updated_at', 'desc')->paginate(3);
		foreach ($articel as $singleArticel) {
			$singleArticel->comments = ArticelComments::where('articel_id', '=', $singleArticel->id)->orderby('updated_at', 'desc')->get();

		}

		return view('frontend.articel.index')->with('articel', $articel);
	}

	public function show($id){

		$articel = Articel::find($id);

		$articel->comments =  ArticelComments::where('articel_id', '=', $id)->orderby('updated_at', 'desc')->paginate(5);
		$articel->commentsCount =  ArticelComments::where('articel_id', '=', $id)->count();
		foreach ($articel->comments as $comment) {
			$comment->user =  User::find($comment->user_id);
		}

		return view('frontend.articel.show')->with('articel', $articel);
	}

	public function storeComment(Request $request,$id){
		
		if ($request->input('content') == "") {
			flash('__(template.forum.flashMessages.storeEmpty)')->warning()->important();
			return back();
		}

		$comment = new ArticelComments();

		$comment->articel_id = $id;
		$comment->user_id = Auth::user()->id;
		$comment->content =  $request->input('content');
		$comment->save();

		flash('Comment saved')->important();
		return back();
	}

	public function deleteComment($id){
		$comment = ArticelComments::find($id);

		$comment->delete();
		flash('Comment deleted')->warning()->important();

		return redirect()->back();
	}

	public function editComment($id,$commentId)
	{
		$comment = ArticelComments::find($commentId);

		return view('frontend.articel.editComment', compact('comment'));


	}

	public function updateComment(Request $request,$id,$commentId)
	{
		$comment =  ArticelComments::find($commentId);

		$comment->content = $request->input('content');
		$comment->save();

		flash('Comment updated')->important();

		return redirect()->route('articel.show',$id);
	}


	public function like($id){
		$articel =  Articel::find($id);

		$articel->increment('likes');


		flash('You liked it!')->success()->important();
		return redirect()->back();
	}

	public function dislike($id){
		$articel =  Articel::find($id);

		$articel->increment('dislikes');


		flash('You disliked it!')->warning()->important();
		return redirect()->back();
	}
}
