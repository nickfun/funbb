@layout('template')

@section('top-title')
Viewing Board: {{$board->description}}
@endsection

@section('content')

	<div class="page-header">
		<h1> {{$board->name}} </h1>
		<small>{{$board->description}}</small>
	</div>

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

	{{-- Form to make a new thread --}}

	@if( Auth::check() )
	<h3>Post a New Thread</h3>
	<form class="form-horizontal" method="post" action="{{URL::to('thread/new')}}">
		<input type="hidden" name="board_id" value="{{$board->id}}">
		<div class="control-group">
			<label class="control-label" for="subject">Subject</label>
			<div class="controls">
				<input type="text" name="subject" placeholder="Subject...">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="body">Your Reply</label>
			<div class="controls">
				<textarea class="replybox" name="body" placeholder="Type Something..."></textarea>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary">Post Reply</button>
			</div>
		</div>
	</form>
	@else
	<div class="row">
		<div class="span12 alert alert-error">
			You can not post a new thread because you are not logged in
		</div>
	</div>
	@endif

@endsection