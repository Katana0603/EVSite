<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use Notifiable;
	use HasRoles;
	use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'email', 'password','confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {   
    	$this->attributes['password'] = bcrypt($password);
    }


    public function clan(){
    	return $this->belongsTo('App\Models\User\Clan');
    }


    public function gender(){
    	return $this->belongsTo('App\Models\User\Gender');
    }


}
