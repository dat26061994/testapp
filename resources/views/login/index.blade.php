<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<style type="text/css">
	.error {width: 220px;height: 30px;background: #F25252;color:white;line-height: 30px;text-align: center;}
	</style>
</head>
<body>
@if(count($errors)>0)
<div class="error">
@foreach($errors->all() as $error)
	<p>{!! $error !!}</p>
@endforeach
</div>
@endif
<form action="" method="POST">
	<table>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<tr>
			<td>Username</td>
			<td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btnLogin" value="Login" /></td>
		</tr>
	</table>
</form>
</body>
</html>