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
        $this->call('UserDatabaseSeeder');
        $this->call('CoreRoleDatabaseSeeder');
        $this->call('CoreUserDatabaseSeeder');
        $this->call('CorePrivilegesSeeder');
    }
}

class UserDatabaseSeeder extends Seeder 
{
	public function run(){
		DB::table('users')->insert([

		]);
	}
}

class CoreRoleDatabaseSeeder extends Seeder 
{
	public function run(){
		DB::table('core_roles')->insert([

		]);
	}
}

class CoreUserDatabaseSeeder extends Seeder 
{
	public function run(){
		DB::table('core_users')->insert([

		]);
	}
}

class CorePrivilegesSeeder extends Seeder
{
	public function run(){
		DB::table('core_privileges')->insert([

		]);
	}
}
