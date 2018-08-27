<?php

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Model;

class forum extends Model
{
    //
	protected $table = 'forum';



	public function categories(){
		return $this->belongsTo('App\Models\Forum\forumCategories');
	}


}
