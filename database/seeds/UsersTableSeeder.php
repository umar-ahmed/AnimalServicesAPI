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
            'username' => 'umar-ahmed',
            'password' => Hash::make('password'),
            'code' => 'A1B2C3D4E5'
        ));

        $user1->dogs()->attach(1);

        $user2 = User::create(array(
            'name' => 'Abhay Vaidya',
            'email' => 'abhay6547@gmail.com',
            'username' => 'abhay-vaidya',
            'password' => Hash::make('password'),
            'code' => 'A5B4C3D2E1'
        ));

        $user2->dogs()->attach(2);
    }
}
