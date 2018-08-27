<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner\Partner;


class PartnerController extends Controller
{
    //

    public function index()
    {
    	$partners =  Partner::where('activ',1)->get();

    	return view('frontend.partner.index', compact('partners'));
    }
}
