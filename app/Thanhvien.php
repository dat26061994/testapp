<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Thanhvien extends Model {

	protected $table = 'thanh_viens';
	
	protected $fillable = ['id','user','pass','level'];

	public $timestamps = false;

}
