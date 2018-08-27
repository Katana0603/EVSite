<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class event_users extends Model
{
    //

	protected $table = 'event_users';
	
	protected $dates = ['deleted_at'];
	
	use SoftDeletes;
}
