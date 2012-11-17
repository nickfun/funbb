@layout('layout')

@section('top-title')
Viewing a thread
@endsection

@section('content')

	@foreach( $postlist->results as $post )
		<div class="row">
			<div class="span3">
				<ul class="post-info">
					<li><strong>{{$post->username}}</strong></li>
					<li>{{$post->created_at}}</li>
				</ul>
			</div>
			<div class="span8 well">
				{{$post->body}}
			</div>
		</div>
	@endforeach

	{{$postlist->links()}}

@endsection