<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\student;
use App\Http\Requests\StudentRequest;


class AddController extends Controller {

	public function add(StudentRequest $request){
		$img = $request->file('Fimages');
	     $imgName = $img->getClientOriginalName();
        

		$st = new student;
		$st->name = $request->txtName;
		$st->sdt = $request->txtPhone;
		$st->email = $request->txtEmail;
		$st->gender = $request->txtGender;
		$st->country = $request->txtCountry;
		$st->img = $imgName;
        $st->save();
        
        $des = 'public/upload/img';
        $img->move($des,$imgName);
        return redirect('form/dangky'); 

        /*echo "<pre>";
        echo "Hình: ".$request->file('Fimages')->getClientOriginalName()."</br>";
        echo "Size: ".$request->file('Fimages')->getSize()."KB </br>";
        echo "Đường Dẫn: ".$request->file('Fimages')->getRealPath()."</br>";
        echo "Loại Hình: ".$request->file('Fimages')->getMimeType()."</br>";
        echo "</pre>";*/

        
	}

}
