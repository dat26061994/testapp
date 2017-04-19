<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\cate;
class CateController extends Controller {

	public function dashboard(){
		return view('admin.dashboard') ;
	} 

	public function getList(){
		$data = cate::select('id','name','orders')->orderBy('id','DESC')->get();
		return view('admin.cate.list',compact('data'));
	}

	public function getAdd(){
		return view('admin.cate.add');
	}

	public function postAdd(CateRequest $request){
		$cate = new cate;
		$cate->name = $request->txtCateName;
		$cate->orders = $request->txtOrders;
		$cate->description = $request->txtDescription;
		$cate->save();
		return redirect()->route('admin.cate.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Complete Add Category']);
	}

	public function getEdit($id){
		$data = cate::find($id)->toArray();
		return view('admin.cate.edit',compact('data','id'));
	}

	public function postEdit(Request $request,$id){
		$this->validate($request,
				['txtCateName' => 'required'],
				['txtCateName.required'	=> 'Cate Name Not Null']

			);
		$this->validate($request,
			['txtDescription' => 'max:300'],
			['txtDescription.max' => 'Description max is 300 digits']
			);

		$cate = cate::find($id);
		$cate ->name = $request->txtCateName;
		$cate ->orders = $request->txtOrders;
		$cate ->description = $request->txtDescription;
		$cate -> save();
		return redirect()->route('admin.cate.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Complete Edit Category']);
	}

	public function getDelete($id){
		
		$cate = cate::find($id);
		$cate->delete($id);
		return redirect()->route('admin.cate.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Complete Delete Category']);
	}

	

}
