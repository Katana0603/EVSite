<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class games extends Model
{
    //

	protected $table = 'games';
	use SoftDeletes;
}
