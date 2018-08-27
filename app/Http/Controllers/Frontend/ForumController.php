<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Forum\forumCategories;
use App\Models\Forum\forumSubCategories;
use App\Models\Forum\forumThreads;
use App\Models\Forum\forumPosts;
use App\User;
use App\Models\User\Level;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
	public function __construct()
	{

	}
    //
	public function index(){
		if (Auth::check() && Auth::user()->can('Vereinsmitglied')) {
			
		$forum = forumCategories::where('active','=',1)->orderby('order')->get();
		}
		else
		{
		$forum = forumCategories::where('active','=',1)->where('intern',0)->orderby('order')->get();

		}

		foreach ($forum as $categorie) {
			// $categorie->subs = forumSubCategories::where('active','=',1)->where('cat_id','=', $categorie->id)->orderby('order')->get();

			$categorie->sub = forumSubCategories::where('cat_id','=',$categorie->id)->orderby('order')->get();

			foreach ($categorie->sub as $SingleSub) {

				$SingleSub->countThreads = 0;
				$SingleSub->countPosts = 0;

				$SingleSub->countThreads = forumThreads::where('subcat_id','=',$SingleSub->id)->count();

				$SingleSub->threads = forumThreads::where('subcat_id','=',$SingleSub->id)->get();

				foreach ($SingleSub->threads as $thread) {
					$SingleSub->countPosts = $SingleSub->countPosts +  forumPosts::where('thread_id', '=', $thread->id)->count();

					$SingleSub->lastPost = forumPosts::latest()->get();

				} 
			}
		}


		return view('frontend.forum.index')->with('forum', $forum);
	}

	public function sub($id){

		$sub = forumSubCategories::where('id','=',$id)->first();

		$sub->threads =  forumThreads::where('active','=',1)->where('subcat_id','=',$id)->orderby('updated_at')->paginate(10);

		foreach ($sub->threads as $thread) {
			$thread->countPosts =  forumPosts::where('thread_id','=',$thread->id)->count();
		}


		return view('frontend.forum.sub')->with('sub', $sub);
	}


	public function thread($id,$threadId){

		$thread = forumThreads::where('id','=',$threadId)->first();

		$thread->user =  User::where('id','=',$thread->author_id)->first();
		$thread->user->level =  Level::where('from','<=',$thread->user->experiencepoints)->where('till','>=',$thread->user->experiencepoints)->first();

		$thread->posts =  forumPosts::where('thread_id', '=',$threadId)->where('active','=',1)->orderby('updated_at', 'desc')->paginate(5);

		foreach ($thread->posts as $post) {
			$post->user = User::where('id', '=', $post->author_id)->first();
			$post->user->level =  Level::where('from','<=',$post->user->experiencepoints)->where('till','>=',$post->user->experiencepoints)->first();
			
		}

		return view('frontend.forum.thread')->with('thread', $thread);

	}


	public function createThread($id){
		return view('frontend.forum.saveThread')->with("id", $id);
	}

	public function storeThread(Request $request, $id){
		$thread = new forumThreads();
		$thread->subcat_id =  $id;
		$thread->author_id =  Auth::user()->id;
		$thread->title =  $request->input('title');
		$thread->content = $request->input('content');
		$thread->active =  1;
		$thread->likes = 0;
		$thread->dislikes = 0;
		$thread->hits = 0;
		$thread->save();
		flash('__(forum.post.storeThread)')->success()->important();

		return redirect()->route('forum.thread', ['id' => $id, 'threadId' => $thread->id ]);
	}


	public function editThread($id,$threadId){
		$thread = forumThreads::find($threadId);

		return view('frontend.forum.editThread')->with('thread',$thread)->with('id', $id);
	}

	public function updateThread(Request $request,$id, $threadId){

		$thread = forumThreads::find($threadId);

		$thread->title =  $request->input('title');
		$thread->content =  $request->input('content');

		$thread->save();

		flash('__(forum.post.updateThread)')->success()->important();
		return redirect()->route('forum.thread', ['id' => $id, 'threadId' => $thread->id ]);
	}

	public function deleteThread($id,$threadId){
		//delete Thread + all Posts from this Thread

		$thread =  forumThreads::find($threadId);

		forumPosts::where('thread_id','=',$threadId)->delete();
		forumThreads::where('id','=',$threadId)->delete();

		flash('__(forum.thread.deleteThread')->success()->important();
		return redirect()->route('forum.sub', ['id'=>$id]);
	}

	public function deletePost($id,$threadId,$postId){
		$post =  forumPosts::find($postId);

		$post->delete();

		flash('__(forum.post.deletePost)')->success()->important();
		return back();
	}

	public function storePost(Request $request,$id,$threadId){
		

		if ($request->input('content') != "") {
			$post = new forumPosts();

			$post->author_id = Auth::user()->id;
			$post->edit_id = Auth::user()->id;
			$post->thread_id =  $threadId;
			$post->content = $request->input('content');
			$post->active = 1;
			$post->likes = 0;
			$post->dislikes = 0;
			$post->hits = 0;
			$post->save();

			flash('__(forum.post.storePost)')->success()->important();
			return back();
		}

		flash('__(forum.post.storeEmpty)')->warning();
		return back();
	}

	public function editPost($id,$threadId, $postId){
		echo "edit Post";
	}

}
