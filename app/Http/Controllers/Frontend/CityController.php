<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;


class CityController extends Controller
{

	public function index(){
		return view('frontend.city.index');
	}

}
