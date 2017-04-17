<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model {

	protected $table = 'product_images';

	protected $fillable = ['name', 'product_id'];

	public $timestamps = true;

	public function product(){
		return $this->hasMany('App/product');
	}

}
