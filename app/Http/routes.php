<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('test',function(){
   echo "Test Router";
});


Route::get('thongtin','WelcomeController@thongtin');

Route::get('laptrinh/{monhoc}',function($monhoc){
      return "FrameWork: $monhoc ";
});

Route::get('city/getAll',function(){
	$data = DB::table('city')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/select',function(){
	$data = DB::table('city')->select('name')->where('id',3)->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/orderby',function(){
	$data = DB::table('city')->orderBy('id','ASC')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/limit',function(){
	$data = DB::table('city')->skip(2)->take(4)->orderBy('id','ASC')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/wherebetween',function(){
	$data = DB::table('city')->wherebetween('id',[2,5])->orderBy('id','ASC')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/whereNOTbetween',function(){
	$data = DB::table('city')->whereNotbetween('id',[2,5])->orderBy('id','ASC')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/wherein',function(){
	$data = DB::table('city')->wherein('id',[2,5])->orderBy('id','ASC')->get();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/count',function(){
	$data = DB::table('city')->count();
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/maxrow',function(){
	$data = DB::table('city')->max('id');
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/AVG',function(){
	$data = DB::table('city')->avg('id');
	echo '<pre>';
	print_r($data);
	echo "</pre>";
});

Route::get('city/insert',function(){
     DB::table('city')->insert([
        'name'=>'Singapo'
     	]);
     return "Insert thành công";
});

Route::get('city/insertcity',function(){
     $id = DB::table('city')->insertGetId([
         'name'=>'Mexico'
     	]);
     echo $id;
});

Route::get('city/update',function(){
     DB::table('city')->where('id',74)->update([
         'name'=>'Seuol'
     	]);
    echo "Update thành công"; 
});

Route::get('city/delete',function(){
     DB::table('city')->where('id',73)->delete();
    echo "Delete thành công"; 
});

Route::get('student/getAll',function(){
	$data = App\student::all()->toJson();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('student/getId',function(){
	$data = App\student::findOrFail(2)->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('student/getWhere',function(){
	$data = App\student::where('id',2)->firstOrFail()->get()->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('student/Count',function(){
	$data = App\student::all()->count();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});

Route::get('student/Raw',function(){
	$data = App\student::whereRaw('email = ?',['dat26061994@gmail.com'])->get()->toArray();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});


Route::get('student/Insert',function(){
	$student = new App\student;
	$student->name = 'Phạm Thế Phong';
	$student->sdt = '0123456789';
	$student->email = 'thephongit97@gmail.com';
	$student->gender = 'Nam';
	$student->country='Hà Nội';
	$student->save();
	echo "Insert thành công";
});

Route::get('student/InsertArray',function(){
	$data = array(
        'name'=>'Nguyễn Đình Sơn',
        'sdt'=>'01236549870',
        'email'=>'son123@gmail.com',
        'gender'=>'Nam',
        'country'=>'Hà Nội',
		);
	App\student::create($data);
	echo "Insert thành công";
});

Route::get('student/Delete',function(){
	App\student::destroy(6);
	echo "Delete thành công";
});

Route::get('form/layout',function(){
	return view('form.layout');
});

Route::post('form/data',['as'=>'sendInfor',function () {
	return "OKE";
}]);

Route::get('form/dangky',function(){
	return view('form.dangky');
});
Route::post('form/dangky2',['as'=>'postDangky','uses'=>'AddController@add']);

/*Route::any('{all?}','WelcomeController@index')->where('all','.*');*/
Route::get('response/redirect',function(){
	return redirect('/');
});

Route::get('response/demo',['as'=>'resdemo',function(){
	return view('response.demo');
}]);

Route::get('response/redirectRoute',function(){
	return redirect()->Route('resdemo')->with([
        'level' => 'danger',
        'messages'=>'Có nguy hiểm'
		]);
});

Route::get('response/macrop/cap',function(){
	return response()->cap('Test Macro');
});

Route::get('response/macrop/contact',function(){
	return response()->contact('http://localhost:8080/FrameWork/laravel-master/response/macrop/cap');
});

Route::get('authen/login',['as'=>'getlogin','uses'=>'ThanhVienController@getlogin']);
Route::post('authen/login',['as'=>'postlogin','uses'=>'ThanhVienController@postlogin']);

Route::get('authentication/getRegister',['as'=>'getRegister','uses'=>'Auth\AuthController@getRegister']);
Route::post('authentication/postRegister',['as'=>'postRegister','uses'=>'Auth\AuthController@postRegister']);
Route::get('authentication/getLogin',['as'=>'getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('authentication/postLogin',['as'=>'postLogin','uses'=>'Auth\AuthController@postLogin']);

Route::get('authentication/demo',function(){
	return view('response.home');
});

Route::resource('students','StudentsController');
