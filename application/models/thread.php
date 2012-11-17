<?php

class Thread extends Eloquent {

	public function author() {
		return new User( $this->author_id );
	}

	/* Relationships */
	public function posts() {
		return $this->has_many('posts');
	}

	public function board() {
		return $this->belongs_to('user', 'board');
	}

	public function user() {
		return $this->has_one('user');
	}
}