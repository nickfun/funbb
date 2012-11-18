<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 64);
			$table->string('password', 64);
			$table->string('email', 100);
			$table->integer('posts');
			$table->integer('isAdmin');
			$table->timestamps();
		});

		// make a default admin account
		DB::table('users')->insert(array(
			'id'		=> 1,
			'username' 	=> 'admin',
			'password'	=> Hash::make('admin'),
			'email'		=> 'admin@funbb.com',
			'posts'		=> 1,
			'isAdmin'	=> 1,
			'created_at'=> DB::raw('NOW()'),
			'updated_at'=> DB::raw('NOW()'),
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
		Schema::drop('users');
	}

}