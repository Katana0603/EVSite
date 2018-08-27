<?php

namespace App\Models\IssueList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IssueList extends Model
{
    //
    protected $table = 'issueLists';
	use SoftDeletes;
}
