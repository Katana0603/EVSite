<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model 
{

	use Softdeletes;

	protected $table = 'calendar_events';

	protected $fillable = [
		'event_name', 'start_date', 'end_date', 'subject', 'desc', 'creationUser_id', 'user_id', 'role_id', 'all'
	];

	protected $dates = ['deleted_at'];
}
