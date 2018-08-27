<?php

namespace App\Models\toDoList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class toDoList extends Model
{
    //
    protected $table = 'toDoList';
	use SoftDeletes;
}
