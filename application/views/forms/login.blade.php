@layout('layout')

@section('top-title')
Login to FunBB
@endsection

@section('content')
<form class="form-horizontal" action="{{ URL::to('auth/login') }}" method="post">
	<fieldset>
		<legend>Login</legend>
		<label>Your Username</label>
			<input type="text" name="username">
		<label>Your Password</label>
			<input type="password" name="password">
		<input type="submit" class="btn btn-primary" value="Register"></label>

	</fieldset>
</form>
@endsection