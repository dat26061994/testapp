@if(count($errors)>0)
   <ul>
    @foreach ($errors->all() as $errors)
   	<li>{!! $errors  !!}</li>
   	@endforeach
   </ul>
@endif

<form enctype="multipart/form-data" action="{!! route('postDangky') !!}" method="post" name="Frmthem">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<table>
		<tr>
			<td>Name</td>
			<td>
			<input type="text" name="txtName">
			
			</td>
		</tr>
		<tr>
			<td>Phone</td>
			<td>
			<input type="text" name="txtPhone">
			
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>
			<input type="text" name="txtEmail">
			
			</td>
		</tr>
		<tr>
			<td>Gender</td>
			<td>
			<input type="text" name="txtGender">
		
			</td>
		</tr>
		<tr>
			<td>Country</td>
			<td>
			<input type="text" name="txtCountry">
			
			</td>
		</tr>
		<tr>
			<td>Images</td>
			<td>
			<input type="file" name="Fimages">
			
			</td>
		</tr>
		
		<tr>
			<td><input type="reset" name="btgreset" value="Xóa"></td>
			<td><input type="submit" name="btgGui" value="Thêm"></td>
		</tr>
	</table>	
</form>