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
			$table->integer('user_id');
			$table->integer('thread_id');
			$table->string('body');
			$table->timestamps();
			// primary is ID, another index on thread_id since we mostly selecty bu thread_id
			$table->index('thread_id');
		});

		// make a default post
		DB::table('posts')->insert(array(
			'id'			=> 1,
			'user_id'		=> 1,
			'thread_id'		=> 1,
			'body'			=> 'This is the first post and it is pretty cool :-D',
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