<?php

class Create_Posts {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('posts', function($table) {
			$table->increments('id');
			$table->integer('author_id');
			$table->integer('thread_id');
			$table->string('body');
			$table->timestamps();
		});

		// make a default post
		DB::table('posts')->insert(array(
			'id'	=> 1,
			'author_id'	=> 1,
			'thread_id'	=> 1,
			'body'		=> 'This is the first post and it is pretty cool :-D',
			'created_at'	=> DB::raw('NOW()'),
			'updated_at'	=> DB::raw('NOW()'),
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('posts');
	}

}