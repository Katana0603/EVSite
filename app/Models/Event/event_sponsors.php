<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class event_sponsors extends Model
{
    //

    protected $table = 'event_sponsors';
    
	use SoftDeletes;
}
