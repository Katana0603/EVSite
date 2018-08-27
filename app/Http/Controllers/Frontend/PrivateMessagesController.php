<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PM\pm;
use App\Models\PM\pm_follow;
use App\User;
use Auth;
use Session;


class PrivateMessagesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getMessages()
	{
		$pms =  pm::where('user1', Auth::user()->id)->orWhere('user2', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
		foreach ($pms as $pm) {
			$pm->messages = pm_follow::where('pm_id',$pm->id)->get();
			$pm->usr1 = User::withTrashed()->where('id',$pm->user1)->first();
			$pm->usr2 = User::withTrashed()->where('id',$pm->user2)->first();
			$pm->unreadCount = 0;
			foreach ($pm->messages as $msg) {
				if ($msg->read == 0 && Auth::user()->id != $msg->fromUser) {
					$pm->unreadMessages = 1;

					$pm->unreadCount = $pm->unreadCount + 1;
				}
			}
			$pm->unreadMessages = 0;
		}

		return view('frontend.PM.getMessages', compact('pms'));

	}

	public function createMessage()
	{
		//Call View to Write a Message

		$toUsers = User::all();

		return view('frontend.PM.createMessage',compact('toUsers'));
	}

	public function createMessageToUser($userId)
	{
		$toUser = User::find($userId);

		return view('frontend.PM.createMessageToSpefUser',compact('toUser'));
	}

	public function sendMessage(Request $request)
	{
		if (!$request->input('content') || $request->input('content') == "" || $request->input('content') == Null) {
			flash('Message need to be filled')->important();
			return redirect()->back()->withInput();
		}

		//Store the written Message
		$pm =  new pm();
		$pm->subject = $request->input('subject');
		$pm->user1 = Auth::user()->id;
		$pm->user2 = $request->input('toUser');

		$pm->save();

		$pm_follow = new pm_follow();
		$pm_follow->pm_id = $pm->id;
		$pm_follow->fromUser = Auth::user()->id;
		$pm_follow->toUser = $pm->user2;
		$pm_follow->message = $request->input('content');
		$pm_follow->read = 0;

		$pm_follow->save();

		return redirect()->route('pm.open.message',[$pm->id]);
	}

	public function openMessage($id)
	{
		//Open a Single Message and all the Histories to the Message
		$pm = pm::find($id);


		//test auf User einbauen

		$pm->messages = pm_follow::where('pm_id',$pm->id)->get();
		foreach ($pm->messages as $message) {
			$message->toUsr = User::withTrashed()->where('id',$message->toUser)->first();
			$message->fromUsr = User::withTrashed()->where('id',$message->fromUser)->first();

		}

		$readMessages = pm_follow::where('pm_id', $pm->id)->where('toUser',Auth::user()->id)->get();

		foreach ($readMessages as $msg) {
			$msg->read = 1;
			$msg->save();
		}

		return view('frontend.PM.showMessage', compact('pm'));
	}

	public function answerMessage($id, Request $request)
	{
		if (!$request->input('content') || $request->input('content') == "" || $request->input('content') == Null) {
			flash('Message need to be filled')->error()->important();
			return redirect()->back();
		}

		$pm_follow = new pm_follow;
		$pm = pm::find($id);

		$pm_follow->pm_id = $id;
		$pm_follow->fromUser = Auth::user()->id;
		

		if ($pm->user1 == Auth::user()->id) {
			$pm_follow->toUser = $pm->user2;
		}
		else
		{
			$pm_follow->toUser = $pm->user1;			
		}

		$pm_follow->message = $request->input('content');

		$pm_follow->read = 0;
		$pm_follow->save();

		$pm->touch();


		return redirect()->back();
	}

	public function deleteMessage($id)
	{
		$pm = pm::find($id);

		pm_follow::where('pm_id', $pm->id)->delete();

		$pm->delete();

		flash('Message deleted')->warning()->important();
		return redirect()->back();

	}
}
