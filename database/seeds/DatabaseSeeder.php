<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Eloquent::unguard();
 
		// Add or Uncomment this line
		$this->call(UsersTableSeeder::class);
        $this->call(DogsTableSeeder::class);

        // Seed oauth_clients
        DB::insert("INSERT INTO oauth_clients (id, secret, name) values (?, ?, ?)", [
            "f3d259ddd3ed8ff3843839b", 
            "4c7f6f8fa93d59c45502c0ae8c4a95b", 
            "Buddi App"
        ]);


        Eloquent::reguard();
    }
}
