<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\IssueList\IssueList;

class IssueListController extends Controller
{


    //

	public function storeIssue(Request $request){

		$issue = new IssueList();

		$issue->user_id = Auth::user()->id;
		$issue->url = $request->input('url');
		$issue->description = $request->input('description');


		$issue->save();

		return back();
	}
}
