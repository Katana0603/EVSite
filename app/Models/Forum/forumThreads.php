<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class forumThreads extends Model
{
    //
	protected $table = 'forumThreads';
	
	use SoftDeletes;
}
