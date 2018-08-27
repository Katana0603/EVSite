<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Calendar\Event;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;

use Session;

class CalendarController extends Controller
{
    //
	public function newItem(Request $request){
		$event = new Event();
		$event->creationUser_id = Auth::user()->id;

		switch ($request->input('choose')) {
			case '1':
			$event->user_id = Auth::user()->id;
			break;
			case '2':

			$event->role_id = $request->input('roleSelect');
			break;
			case '3':
			$event->all = 1;
			break;
			
			default:
			$event->user_id = Auth::user()->id;
			break;
		}
		$event->subject = $request->input('subject');
		$event->desc = $request->input('content');

		$event->start_date = date("Y-m-d H:i:s",strtotime($request->input('start_eventdatetime')));
		$event->end_date = date("Y-m-d H:i:s",strtotime($request->input('end_eventdatetime')));

		if ($request->input('allDay')) {
			$event->allDay = 1;
		}

		$event->save();

		flash('Event ' . $event->subject . ' saved')->success()->important();
		return redirect()->back();

	}

	public function index()
	{
		if (!Auth::user()->hasPermissionTo('Calendar-Admin')) //If user does //not have this permission
		{
			abort('401');
		}

		$userRoles = Auth::user()->roles()->get();
		$userRolesIds = array();

		foreach ($userRoles as $role) {
			array_push($userRolesIds, $role->id);
		}

		$calendar = Event::where('user_id', Auth::user()->id)->orWhereIn('role_id', $userRolesIds)->orWhere('all',1)->get();

		foreach ($calendar as $event) {
			if ($event->role_id) {
				
				$event->role = Role::find($event->role_id);

			}
		}

		return view('backend.admin.calendar', compact('calendar','userRoles'));

	}
}
