@layout('layout')

@section('top-title')
Viewing a thread
@endsection

@section('content')

	<div class="page-header well">
		<h1>{{$thread->subject}}</h1>
		<small>Started {{$thread->created_at}}
		Has {{$thread->postcount}} {{Str::plural('post', $thread->postcount)}}</small>
	</div>

	@foreach( $postlist->results as $post )
		<div class="row">
			<div class="span8 well">
				{{$post->body}}
			</div>
			<div class="span3">
				<ul class="post-info">
					<li><strong>{{$post->username}}</strong></li>
					<li>{{$post->created_at}}</li>
				</ul>
			</div>
		</div>
	@endforeach

	{{$postlist->links()}}

	{{-- Form to post a reply if the user is logged in --}}
	@if( Auth::check() )
	<form class="form-horizontal" action="{{ URL::to('thread/reply') }}" method="post">
		<input type="hidden" name="thread_id" value="{{$thread->id}}">
		<div class="control-group">
			<label class="control-label" for="reply">Your Reply</label>
			<div class="controls">
				<textarea class="replybox" name="reply" placeholder="Type Something..."></textarea>
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
			You can not post a reply because you are not logged in
		</div>
	</div>
	@endif

@endsection