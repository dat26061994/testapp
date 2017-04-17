<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CateController extends Controller {

	public function getList(){
		return view('admin.cate.list');
	}

	public function getAdd(){
		return view('admin.cate.add');
	}

	public function postAdd(){

	}

	public function getEdit(){
		return view('admin.cate.edit');
	}

	public function postEdit(){

	}

	public function getDelete(){

	}

	public function postDelete(){
		
	}

}
