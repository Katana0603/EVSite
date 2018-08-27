<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use Session;
class LayoutController extends Controller
{
	//


	public function __construct() {
		$this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources

	}

	public function widgets(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.widgets');
	}

	public function chartsjs(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.chartsjs');
	}

	public function chartsMorris(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.chartsMorris');
	}

	public function chartsFlot(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.chartsFlot');
	}

	public function chartsInline(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.chartsInline');
	}

	public function elementsGeneral(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsGeneral');
	}

	public function elementsIcons(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsIcons');
	}

	public function elementsButtons(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsButtons');
	}

	public function elementsSliders(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsSliders');
	}

	public function elementsTimeline(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsTimeline');
	}

	public function elementsModals(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.elementsModals');
	}

	public function formsGeneral(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.formsGeneral');
	}

	public function formsAdvanced(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.formsAdvanced');
	}

	public function formsEditors(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.formsEditors');
	}

	public function tablesSimple(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.tablesSimple');
	}

	public function tablesData(){
		if (!Auth::user()->hasPermissionTo('Layout-Admin')) //If user does //not have this permission
		{
			abort('401');
		}
		return view('backend.admin.layout.tablesData');
	}

}
