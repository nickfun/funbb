<?php

class Threads {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('threads', function($table) {
			$table->increments('id');
			$table->integer('board_id');
			$table->integer('author_id');
			$table->string('subject');
			$table->integer('postcount');
			$table->timestamps();
		} );

		// make a default thread
		DB::table('threads')->insert(array(
			'id'			=> 1,
			'board_id'		=> 1,
			'author_id'		=> 1,
			'subject'		=> 'First Thread!',
			'postcount'		=> 1,
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
		Schema::drop('threads');
	}

}