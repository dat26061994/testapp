<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cate extends Model {

	protected $table = 'cates';

	protected $fillable = ['name', 'alias', 'orders', 'parent_id', 'keywords', 'description'];

	public $timestamps = true;

		public function product(){
			return $this->hasMany('App\product');
		}
}
