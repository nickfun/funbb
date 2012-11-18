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
		return View::make('post-list')
			->with('postlist', $postlist)
			->with('thread', $thread);
	}

	/**
	 * Process posting a reply to an existing thread
	 */
	public function post_reply() {
		// must be logged in
		// @todo: set this up with a filter
		if( Auth::guest() ) {
			return Redirect::to('/');
		}

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
			// we are done, go back to the thread
			return Redirect::to('thread/view/' . $data['thread_id']);
		}
	}


//=======================================================
	/** 
	 * Display the login form
	 */
	public function get_login() {
		return View::make('forms.login');
	}

	/** 
	 * Process the login form
	 */
	public function post_login() {
		// process the form I guess!
		$creds = array(
			'username'	=> Input::get('username'),
			'password'	=> Input::get('password'),
		);
		if( Auth::attempt($creds) ) {
			Session::flash('status', 'login-success');
			return Redirect::to('/');
		} else {
			Session::flash('status', 'login-fail');
			return Redirect::to('auth/login');
		}
	}

	/**
	 * Logout a user
	 */
	public function get_logout() {
		Auth::logout();
		Session::flash('status', 'logout');
		return Redirect::to('/');
	}

	/**
	 * Display the register form
	 */
	public function get_register() {
		return View::make('forms.register-user');
	}

	/**
	 * Process the register form
	 */
	public function post_register() {
		$rules = array(
			'username'	=> 'required',
			'email'		=> 'required|email|unique:users',
			'password'	=> 'required|same:password-confirm',
			'password-confirm'	=> 'required',
		);

		$data = Input::get();

		$val = Validator::make($data, $rules);
		if( $val->fails() ) {
			//Input::flash(); // save form data for view
			return Redirect::to('auth/register')
				->with_input()
				->with_errors($val);
		} else {
			$data = Input::get(); // im not sure if Validator is destructive to the data it gets passed so I'll just get it again from the input class

			$user = new User();
			$user->username = $data['username'];
			$user->email 	= $data['email'];
			$user->password = Hash::make( $data['password']);
			$user->isAdmin = 0;
			$user->save();
			// login the user right now
			Auth::login( $user->id );

			Session::flash('status', 'register-success');
			return Redirect::to('/');
		}
	}

	public function get_users() {
		$userlist = DB::table('users')
			->order_by('username', 'asc')
			->paginate(3);
		return View::make('user-list')->with('userlist', $userlist);
	}
}