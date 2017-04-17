<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentsController;
use App\students;
use Illuminate\Http\Request;

class StudentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$student = students::all();
        
		return view('restful.list',compact('student'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('restful.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$st = new students;
		$st->name= $request->txtName;
		$st->phone= $request->txtPhone;
		$st->email= $request->txtEmail;
		$st->gender= $request->txtGender;
		$st->country= $request->txtCountry;
		$st->save();
		return redirect()->route('students.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = students::findOrFail($id);
		return view('restful.edit',compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$student = students::find($id);
		$student->name=$request->txtHoTen;
		$student->phone=$request->txtPhone;
		$student->email=$request->txtEmail;
		$student->gender=$request->txtGender;
		$student->country=$request->txtCountry;
		$student->save();
		return redirect()->route('students.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
         $student = students::findOrFail($id);
         $student->delete();
         return redirect()->route('students.index');
	}

}
