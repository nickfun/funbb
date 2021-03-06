<?php

class Create_Threads {

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
			$table->integer('user_id');
			$table->string('subject');
			$table->integer('postcount');
			$table->timestamps();
			// primary on id, index on board_id
			$table->index('board_id');
		} );

		// make a default thread
		DB::table('threads')->insert(array(
			'id'			=> 1,
			'board_id'		=> 1,
			'user_id'		=> 1,
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