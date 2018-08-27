<?php

namespace App\Models\PM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pm_follow extends Model
{
	

    use SoftDeletes;
    protected $table = 'pm_follow';

    protected $dates = ['deleted_at'];
}
