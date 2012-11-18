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

@endsection