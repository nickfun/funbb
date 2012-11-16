<?php

class Create_Boards {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('boards', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->integer('position');
			$table->timestamps();
		});

		// make a default board
		DB::table('boards')->insert(array(
			'id'			=> 1,
			'name'			=> 'Discussion',
			'description'	=> 'A place for everyone to talk',
			'position'		=> 0,
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
		Schema::drop('boards');
	}

}