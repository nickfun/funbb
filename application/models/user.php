<?php

/**
 * User model for FunBB
 * lots of magic is taken care of by Eloquent
 *
 * @author Nicholas Funnell <nick@nick.gs>
 * @package models
 */
class User extends Eloquent {

	public static $table = 'users';

	// **NOTE** the Users model can NOT have a custom key, as the Auth driver in Larvel is hard coded to check the default id of "id"
	//public static $key = 'user_id';

	/* setup relationships */

	// a user has many posts
	public function posts() {
		return $this->has_many('posts');
	}

}