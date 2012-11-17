<?php

class Post extends Eloquent {

	/* Relationships */
	public function user() {
		return $this->belongs_to('user');
	}
}