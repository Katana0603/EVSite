<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event_sitzplatz extends Model
{
    //

    protected $table = 'event_sitzplatz';
	use SoftDeletes;
}
