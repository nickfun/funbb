@layout('layout')

@section('top-title')
Viewing Board: {{$board->description}}
@endsection

@section('content')

	<h1>{{$board->description}} </h1>

	@foreach( $threadlist->results as $thread )
	<div class="row">
		<div class="span8 well">
			<a href='{{URL::to("thread/" . $thread->id)}}'>
				<h3>{{$thread->subject}}</h3>
			</a>
		</div>
		<div class="span3">
			<ul class="thread-info">
				<li>Posted by {{$thread->username}} </li>
				<li>Started on {{$thread->created_at}} </li>
				<li>Has {{$thread->postcount}} {{Str::plural('post', $thread->postcount)}}  </li>
			</ul>
		</div>
	</div>
	@endforeach

	{{ $threadlist->links() }}

	@if( Auth::guest() )
	<div class="alert">
		<strong>You can not start a thread because you are not logged in</strong>
	</div>
	@else
	<div class="alert alert-success">
		POST A THREAD
	</div>
	@endif

@endsection