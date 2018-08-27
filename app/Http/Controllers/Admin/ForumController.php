<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Forum\forum;
use App\Models\Forum\forumCategories;
use App\Models\Forum\forumSubCategories;
use App\Models\Forum\forumThreads;
use App\Models\Forum\forumPosts;
use App\User;
use App\Models\User\Level;
use Auth;
use Session;

class ForumController extends Controller
{


	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function index(){
		if (!Auth::user()->hasPermissionTo('Forum-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		// Categories
		$cats =  forumCategories::all();
		foreach ($cats as $cat) {
			$cat->count = forumSubCategories::where('cat_id','=',$cat->id)->count();
		}

		$subs = forumSubCategories::all();
		foreach ($subs as $sub) {
			$sub->count = forumThreads::where('subcat_id','=',$sub->id)->count();
		}
		$threads = forumThreads::all();
		foreach ($threads as $thread) {
			$thread->count = forumPosts::where('thread_id','=',$thread->id)->count();
			$thread->author =  User::find($thread->author_id);
		}

		$authors = User::all();


		// $forums =  forum::all();
		// foreach ($forums as $forum) {
		// 	$forum->cats = forumCategories::where('forum_id','=',$forum->id)->get();

		// 	foreach ($forum->cats as $cat) {
		// 		$cat->subs =  forumSubCategories::where('cat_id','=',$cat->id)->get();


		// 		foreach ($cat->subs as $sub)  {
		// 			$sub->threads = forumThreads::where('subCat_id','=',$sub->id)->get();

		// 			foreach ($sub->threads as $thread) {
		// 				$thread->posts = forumPosts::where('thread_id','=',$thread->id)->get();
		// 			}
		// 		}
		// 	}
		// }

		return view('backend.forum.index', compact('cats', 'subs', 'threads', 'authors'));
	}



// STORE SECTION



	public function storeCat(Request $request){


		$cat =  new forumCategories();

		$cat->title =  $request->input('title');
		$cat->description =  $request->input('description');
		if ($request->input('active') !== null) {
			$cat->active = 1;
		} else {
			$cat->active = 0;
		}

		$cat->order =  $request->input('order');
		$cat->forum_id =  1;

		$cat->save();

		flash('Cat successful stored')->success()->important();

		return redirect()->back();
	}

	public function storeSub(Request $request){

		$subCat = new forumSubCategories();

		$subCat->cat_id =  $request->input('cat_id');
		$subCat->title =  $request->input('title');
		$subCat->description = $request->input('description');
		if ($request->input('active') !== null) {
			$subCat->active = 1;
		} else {
			$subCat->active = 0;
		}
		$subCat->order =  $request->input('order');

		$subCat->save();

		flash('Sub successful stored')->success()->important();

		return redirect()->back();

	}

	public function storeThread(Request $request){


		$thread = new forumThreads();

		$thread->author_id =  $request->input('author_id');
		$thread->subcat_id =  $request->input('subcat_id');
		$thread->title =  $request->input('title');
		$thread->content = $request->input('content');
		if ($request->input('active') !== null) {
			$thread->active = 1;
		} else {
			$thread->active = 0;
		}
		$thread->order =  $request->input('order');
		$thread->hits = 0;
		$thread->likes = 0;
		$thread->dislikes = 0;

		$thread->save();

		flash('Thread successful stored')->success()->important();

		return redirect()->back();
	}

	public function storePost(Request $request){

		flash('Post successful stored')->success()->important();

		return redirect()->back();
	}



// DELETE SECTION

	public function deleteCat($id){

		$cat = forumCategories::find($id);

		$cat->subs = forumSubCategories::where('cat_id','=',$cat->id)->get();

		foreach ($cat->subs as $sub) {
			$sub->threads =  forumThreads::where('subcat_id','=',$sub->id)->get();

			foreach ($sub->threads as $thread) {
				$thread->posts =  forumPosts::where('thread_id','=',$thread->id)->get();


				foreach ($thread->posts as $post) {
					$post->delete();
				}

				$thread->delete();
			}

			$sub->delete();
		}

		$cat->delete();
	}

	public function deleteSub($id){

		$sub = forumSubCategories::find($id);

		$sub->threads = forumThreads::where('subcat_id','=',$sub->id)->get();

		foreach ($sub->threads as $thread) {
			$thread->posts = forumPosts::where('thread_id','=',$thread->id)->get();

			foreach ($thread->posts as $post) {
				$post->delete();
			}

			$thread->delete();
		}

		$sub->delete();


		flash('successful deleted with all dependencies')->warning()->important();
		return redirect()->back();

	}

	public function deleteThread($id){

		$thread =  forumThreads::find($id);

		$thread->posts =  forumPosts::where('thread_id','=',$thread->id)->get();


		foreach ($thread->posts as $post) {
			$post->delete();
		}

		$thread->delete();

		flash('successful deleted with all dependencies')->warning()->important();
		return redirect()->back();
	}

}
