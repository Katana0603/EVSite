<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event extends Model
{
    //

	protected $table = 'event';


	protected $dates = ['event_end','lastAccountCheck','event_start','signup_start','signup_end', 'seatReserve_start', 'seatReserve_end','deleted_at'];
	
	use SoftDeletes;

	

	protected static function boot() {
		parent::boot();

		static::deleting(function($parent) {
			$parent->event_users()->delete();
			$parent->sponsor()->delete();
			$parent->partner()->delete();
			$parent->event_tournament()->delete();


		});
	}


	public function event_users(){
		return $this->hasMany('App\Models\Event\event_users');
	}

	public function sponsor(){
		return $this->hasMany('App\Models\Event\event_sponsors');
	}
	public function partner(){
		return $this->hasMany('App\Models\Event\event_partner');
	}
		public function event_tournament(){
		return $this->hasMany('App\Models\Event\event_tournament');
	}

}
