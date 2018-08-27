<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //
    //


	public function city(){
		return view('backend.sites.city');
	}

	public function citysave(Request $request)
	{
		
	}
}
