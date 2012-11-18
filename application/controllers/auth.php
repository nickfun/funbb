<?php

/**
 * Auth controller
 * 
 * Lets users register, login, logout, basic stuff
 */
class Auth_Controller extends Base_Controller {
	public $restful = true;

	public function get_index() {
		return Redirect::to('/');
	}

	public function get_login() {
		return View::make('forms.login');
	}

	public function post_login() {
		return "Deal with login form";
	}
}