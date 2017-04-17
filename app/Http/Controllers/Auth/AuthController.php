<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Hash;
use App\User;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function getRegister(){
         return view('auth.register');
	}
	public function postRegister(RegisterRequest $request){

		$thanhvien = new User;
		$thanhvien->name=$request->name;
		$thanhvien->email=$request->email;
		$thanhvien->password= Hash::make($request->password);
		$thanhvien->remember_token=$request->_token;
		$thanhvien->save();
	}

	public function getLogin(){
          return view('auth.login');
	}

	public function postLogin(LoginRequest $request){
		$auth = array(
              'email' => $request->email,
              'password' => $request->password
			);
          if ($this->auth->attempt($auth)) {
          	return $this->user()->user;
          }else{
          	echo "Thất Bại";
          }
	}


}
