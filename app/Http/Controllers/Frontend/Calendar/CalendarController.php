<?php

namespace App\Http\Controllers\Frontend\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;use Auth;
use Validator;
use App\Models\Calendar\Event;

use Calendar;

class CalendarController extends Controller
{
	public function index(){
		$events = Event::get();
		$event_list = [];
		foreach ($events as $key => $event) {
			$event_list[] = Calendar::event(
				$event->event_name,
				true,
				new \DateTime($event->start_date),
				new \DateTime($event->end_date.' +1 day')
			);
		}
		$calendar_details = Calendar::addEvents($event_list); 

		return view('frontend.calendar.index', compact('calendar_details') );
	}

	public function addEvent(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'event_name' => 'required',
			'start_date' => 'required',
			'end_date' => 'required'
		]);

		if ($validator->fails()) {
			\Session::flash('warnning','Please enter the valid details');
			return redirect('fronend.calendar.index')->withInput()->withErrors($validator);
		}

		$event = new Event;
		$event->event_name = $request['event_name'];
		$event->start_date = date("Y-m-d H:i:s",strtotime($request['start_date']));
		$event->end_date = date("Y-m-d H:i:s",strtotime($request['end_date']));
		$event->save();

		\Session::flash('success','Event added successfully.');
		return redirect()->back();
	}

}
