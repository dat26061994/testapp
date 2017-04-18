<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model {

	protected $table = 'products';

	protected $fillable = ['name', 'price', 'image', 'description', 'orders', 'status'];

	public $timestamps = true;

	public function cate(){
		return $this->belongTo('App/cate');
	}

	public function user(){
		return $this->hasMany('App/User');
	}
	public function product_images(){
		return $this->hasMany('App/ProductImages');
	}

}
