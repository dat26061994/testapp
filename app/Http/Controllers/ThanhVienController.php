<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ThanhVienRequest;
class ThanhVienController extends Controller {

    public function getlogin(){
           return view('login.index');
    }

     public function postlogin(ThanhVienRequest $request){
    	
    }

}
