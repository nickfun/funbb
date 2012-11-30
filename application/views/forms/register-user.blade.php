@layout('template')

@section('top-title')
Register a new User
@endsection

@section('content')
<form class="form-horizontal" action="{{ URL::to('auth/register') }}" method="post">
	<fieldset>
		<legend>Register a new user</legend>
		<label>Your Username</label>
			<input type="text" name="username">
		
		<label>Your Email</label>
			<input type="text" name="email">
		
		<label>Your Password</label>
			<input type="password" name="password">
		
		<label>Confirm Password</label>
			<input type="password" name="password-confirm">
		<label>
		<input type="submit" class="btn btn-primary" value="Register"></label>
		{{ Form::token() }}
	</fieldset>
</form>
@endsection