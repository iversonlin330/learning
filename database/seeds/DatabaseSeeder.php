<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		DB::table('users')->insert([
			'account' => 'Admin@gmail.com',
            'name' => "Admin",
			'role' => 99,
			'gender' => 1,
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
