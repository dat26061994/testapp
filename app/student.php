<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
* 
*/
class student extends Model
{
	protected $table = 'student';
	
	protected $fillable = ['id','name','sdt','email','gender','country'];

	public $timestamps = false;
}
