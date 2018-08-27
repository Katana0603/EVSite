<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event_sitzplan extends Model
{
    //

    protected $table = 'event_sitzplan';
	use SoftDeletes;
}
