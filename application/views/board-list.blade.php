@layout('template')

@section('top-title')
FunBB Homepage
@endsection

@section('content')

    <div class="hero-unit">
        <h1>FunBB - Discussions for everyone!</h1>
        <p>Welcome to our website about talking and communication</p>
    </div>

    <div class="span12">
        <p>Here are the boards</p>
    </div>

    @foreach( $boardlist as $board )
    <div class="row">
        <div class="span11 well ">
            <a href="{{ URL::to("board/$board->id") }}">
                <h3>{{$board->name}}</h3>
                <h4>{{$board->description}}</h4>
            </a>
        </div>
    </div>
    @endforeach

    @if( Auth::check() && Auth::user()->isadmin )
    <h3>Make a new Board</h3>
    <form class="form-horizontal" method="post" action="{{URL::to('board/new')}}">
        <div class="control-group">
            <label class="control-label" for="name">Board Name</label>
            <div class="controls">
                <input type="text" name="name" placeholder="Board Name...">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="description">Description</label>
            <div class="controls">
                <input type="text" name="description" placeholder="Describe the board">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="position">Position</label>
            <div class="controls">
                <input type="text" name="position" placeholder="0">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary">Make a Board</button>
            </div>
        </div>
    </form>
    @endif
@endsection