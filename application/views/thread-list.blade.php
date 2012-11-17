@layout('layout')

@section('top-title')
{{$board->description}}
@endsection

@section('content')

	@foreach($threadlist as $thread)
	<div class="row">
		<div class="span12 well">
			<a href='{{URL::to("thread/$thread->id")}}'>
				<h3>{{$thread->subject}}</h3>
			</a>
		</div>
	</div>
	@endforeach

@endsection