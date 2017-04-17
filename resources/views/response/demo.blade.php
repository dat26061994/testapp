<style>
	.danger{
		color: red;
	}
	.inf{
		color: blue;
	}
</style>

@if(Session::has('messages'))
<span class="{{ Session::get('level') }}">
	{{ Session::get('messages') }}
</span>

@endif