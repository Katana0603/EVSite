<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event_tournament extends Model
{
    //

    protected $table = 'event_tournament';
	use SoftDeletes;
}
