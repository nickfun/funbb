<?php

/**
 * Thread controller
 * 
 * Lists contents of a thread and creates a new thread with a post
 * Also handles adding a post to an existing thread
 */
class Thread_Controller extends Base_Controller {

	public $restful = true;

	/**
	 * Constructor. Setup my filters
	 */
	public function __construct() {
		parent::__construct();

		$this->filter('before', 'auth')
			->only(array('post_reply', 'post_new'));
	}

	/**
	 * Default action. Redirect to homepage
	 */
	public function get_index() {
		return Redirect::to('/');
	}

	/**
	 * Show one thread
	 */
	public function get_view($thread_id) {
		$postlist = DB::table('posts')
			->join('users', 'posts.user_id', '=', 'users.id')
			->where('posts.thread_id', '=', $thread_id)
			->order_by('posts.created_at', 'asc')
			->paginate('10');
		$thread = Thread::find( $thread_id );
		//return Response::json(array($thread, $postlist));
		return View::make('post-list')
			->with('postlist', $postlist)
			->with('thread', $thread);
	}

	/**
	 * Process posting a reply to an existing thread
	 */
	public function post_reply() {

		// validate data
		$data = Input::get();
		$rules = array(
			'thread_id'	=> 'required',
			'reply'		=> 'required',
		);
		$val = Validator::make($data, $rules);
		if( $val->fails() ) {
			Session::flash('status', 'reply-fail');
			return Redirect::to('/');
		}
		else
		{
			// make the post
			$post = new Post();
			$user = Auth::user();
			// add the info
			$post->user_id 		= $user->id;
			$post->thread_id 	= $data['thread_id'];
			$post->body 		= $data['reply'];
			$post->save();
			// add to the users posts count
			$user->posts++;
			$user->save();
			// add to the reply count in the thread
			$thread = Thread::find( $data['thread_id'] );
			$thread->postcount++;
			$thread->save();
			// notification for user
					Session::flash('status', 'new-post');
			// we are done, go back to the thread
			return Redirect::to('thread/view/' . $data['thread_id']);
		}
	}

	public function get_new() {
		return Redirect::to('/');
	}

	/**
	 * Make a new thread
	 */
	public function post_new() {
		$data = Input::get();
		$rules = array(
			'board_id'	=> 'required',
			'subject'	=> 'required',
			'body'		=> 'required',
		);
		$val = Validator::make($data, $rules);
		if( $val->fails() ) {
			return Redirect::to('/')
				->with_input()
				->with_errors($val);
		}
		else
		{
			// make the thread!
			$user = Auth::user();
			$thread = new Thread();
			$thread->board_id 	= $data['board_id'];
			$thread->user_id 	= $user->id;
			$thread->subject 	= $data['subject'];
			$thread->postcount 	= 1;
			$thread->save();
			// make the 1st post
			$post = new Post();
			$post->user_id 	= $user->id;
			$post->thread_id = $thread->id;
			$post->body 	= $data['body'];
			$post->save();
			// update the users post count
			$user->posts++;
			$user->save();

			return Redirect::to('thread/view/' . $thread->id );
		}

		return Response::json($data);
	}

}
