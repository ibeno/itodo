<?php

class UserTableSeeder extends Seeder{

	public function run(){

		DB::table('users')->delete();

		User::create(array(

			'email' => 'iberno@outlook.com',
			'password' => Hash::make(1234)
		));
	}
}