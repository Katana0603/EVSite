<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pm extends Model
{
	use Softdeletes;

    protected $table = 'pm';

    protected $dates = ['deleted_at'];
}
