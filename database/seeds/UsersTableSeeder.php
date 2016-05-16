<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
 
        $user1 = User::create(array(
            'name' => 'Umar Ahmed',
            'email' => 'umar.ahmed1998@gmail.com',
            'password' => Hash::make('password'),
            'code' => '12345'
        ));

        $user1->dogs()->attach(1);

        $user2 = User::create(array(
            'name' => 'Abhay Vaidya',
            'email' => 'abhay6547@gmail.com',
            'password' => Hash::make('password'),
            'code' => '54321'
        ));

        $user2->dogs()->attach(2);
    }
}
