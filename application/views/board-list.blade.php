@layout('layout')

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
                <div class="span1 well"> 
                    <a href="{{ URL::to('board/' . $board->id ) }}">
                      <h3> &raquo; </h3> 
                    </a>
                </div>
                <div class="span10 well ">
                    <a href="{{ URL::to("board/$board->id") }}">
                        <h3>{{$board->description}}</h3>
                    </a>
                </div>
            </div>
            @endforeach

@endsection