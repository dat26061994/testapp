<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\cate;
use App\product;
use Illuminate\Http\Request;
use File;
use input;
class ProductController extends Controller {

	public function getList(){
		$data = product::select('id','name','orders','status','price','created_at','image','cate_id')->orderBy('id','DESC')->get()->toArray();
		return view('admin.product.list',compact('data'));
	}

		public function getAdd(){
		$cate = cate::select('id','name')->get();	
		return view('admin.product.add',compact('cate'));
	}

	public function postAdd(ProductRequest $request){
		$file_name = $request->file('fImages')->getClientOriginalName();
		$product = new product;
		$product->cate_id = $request->sltCate;
		$product->name = $request->txtName;
		$product->price = $request->txtPrice;
		$product->image = $file_name;
		$product->description = $request->txtDescription;
		$product->orders = $request->txtOrders;
		$product->status = $request->rdoStatus;
		$product->user_id = 1;
		$request->file('fImages')->move('resources/upload/',$file_name);
		$product->save();
		return redirect()->route('admin.product.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Complete Add Product']);
	}

	public function getDelete($id){
		$product = product::find($id);
		File::delete('resources/upload/'.$product->image);
		$product->delete($id);
		return redirect()->route('admin.product.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Delete a Product']);
	}

	public function getEdit($id){
		$cate = cate::select('id','name')->get();
		$product = product::find($id)->toArray();
		return view('admin.product.edit',compact('cate','product','id'));
	}

	public function postEdit($id,Request $request){
		$product = product::find($id);
		
		
		$product->cate_id = $request->sltCate;
		$product->name = $request->txtName;
		$product->price = $request->txtPrice;
		$product->image;
		$product->description = $request->txtDescription;
		$product->orders = $request->txtOrders;
		$product->status = $request->rdoStatus;
		$product->user_id = 1;
		$img_current = 'resources/upload/'.$request->img_current;
		
		if (!empty($request->file('fImages'))) {
			$file_name = $request->file('fImages')->getClientOriginalName();
			$product->image = $file_name;
			$request->file('fImages')->move('resources/upload/',$file_name);
			if (File::exists($img_current)) {
				File::delete($img_current);
			}
		}else{
			echo "khong co file";
		}
		$product->save();
		return redirect()->route('admin.product.getList')->with(['flash_level'=>'success','flash_message'=>'Success!! Edit a Product']);
	}


}
