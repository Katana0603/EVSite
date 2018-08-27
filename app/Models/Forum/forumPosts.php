<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class forumPosts extends Model
{
	protected $table = 'forumPosts';

	use SoftDeletes;

}
