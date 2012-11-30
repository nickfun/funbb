@layout('template')

@section('top-title')
List of all the users
@endsection

@section('content')
<div class="page-header">All users</div>

@foreach( $userlist->results as $user)
<div class="row">
	<div class="span11 well">
		<ul class="user-list-info">
			<li><strong>{{$user->username}}</strong> </li>
			<li>Registered on {{$user->created_at}} </li>
			<li>Has {{$user->posts}} {{Str::plural('post', $user->posts)}} </li>
			<li>Contact: <a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
		</ul>
	</div>
</div>
@endforeach

{{$userlist->links()}}

@endsection