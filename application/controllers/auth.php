<?php

/**
 * Auth controller
 * 
 * Lets users register, login, logout, basic stuff
 */
class Auth_Controller extends Base_Controller {
	
	public $restful = true;

	/**
	 * Default action. Redirect to homepage
	 */
	public function get_index() {
		return Redirect::to('/');
	}

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