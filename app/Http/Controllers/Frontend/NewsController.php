<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\User;
use App\Models\News\NewsComments;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{


    //
	public function index(){
		$news = News::where('status', '=','1')->orderby('orderNumber')->orderby('updated_at','desc')->paginate(3);
		foreach ($news as $singleNews) {
			$singleNews->comments = NewsComments::where('news_id', '=', $singleNews->id)->orderby('updated_at', 'desc')->get();

		}

		return view('frontend.news.index')->with('news', $news);
	}

	public function show($id){

		$news = News::find($id);

		$news->comments =  NewsComments::where('news_id', '=', $id)->orderby('created_at', 'desc')->paginate(5);

		foreach ($news->comments as $comment) {
			$comment->user =  User::find($comment->user_id);
		}

		return view('frontend.news.show')->with('news', $news);
	}

	public function storeComment(Request $request,$id){
		

		if ($request->input('content') != "") {
			$comment = new NewsComments();
			$comment->news_id = $id;
			$comment->user_id = Auth::user()->id;
			$comment->content =  $request->input('content');
			$comment->save();


			flash(__('template.flashMessages.CommentSaved'))->success()->important();
			return back();

		}

		flash('__(forum.flashMessages.storeEmpty)')->warning()->important();
		return back();
	}

	public function deleteComment($id){
		$comment = NewsComments::find($id);

		$comment->delete();


		return back();
	}

	public function editComment($id)
	{

		$comment = NewsComments::find($id);
		return view('frontend.news.editComment', compact('comment'));
	}


	public function updateComment(Request $request,$id)
	{


		$comment = NewsComments::find($id);

		$comment->content = $request->input('content');
		$comment->save();


		flash('Comment updated')->important();
		return redirect()->route('news.show', $comment->news_id);


		echo "update Comment";



	}
}
