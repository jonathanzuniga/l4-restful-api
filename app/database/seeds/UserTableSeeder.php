<?php
 
class UserTableSeeder extends Seeder {
 
	public function run()
	{
		DB::table('users')->delete();
 
		User::create(array(
			'username' => 'tester1',
			'password' => Hash::make('tester1')
		));
 
		User::create(array(
			'username' => 'tester2',
			'password' => Hash::make('tester2')
		));
	}
 
}
