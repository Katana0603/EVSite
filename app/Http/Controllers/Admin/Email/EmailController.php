<?php

namespace App\Http\Controllers\Admin\Email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Mail;

use Session;

class EmailController extends Controller
{

	public function __construct() {
		$this->middleware(['auth']); 
		//isAdmin middleware lets only users with a //specific permission permission to access these resources
	}

	public function send(Request $request)
	{	
		if (!Auth::user()->hasPermissionTo('Email')){
			abort('401');
		}


		$to = $request->input('to');
		$cc = $request->input('cc');
		$bcc = $request->input('bcc');
		$title = $request->input('title');
		$content = $request->input('content');

		$subject = $request->input('subject');

		Mail::send('email.send', [
			'to' => $to,
			'cc' => $cc,
			'bcc' => $bcc,
			'subject' =>  $subject,
			'title' => $title,
			'content' => $content,
		], function($message)
		{
			
			$user  = Auth::user();

			$message->from($user->email, $user->username);
		});



	}

}
