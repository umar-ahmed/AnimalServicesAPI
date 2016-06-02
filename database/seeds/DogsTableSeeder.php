<?php

use Illuminate\Database\Seeder;
use App\Dog;

class DogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dogs')->delete();
 
        Dog::create(array(
        	'reference_num' => 'A700423',
            'name' => 'Remy',
            'age' => 11,
            'size' => 'small',
            'gender' => 'male',
            'breed' => 'Lhasa Apso mix',
            'color' => 'white',
            'declawed' => true,
            'neutered' => false,
            'location' => array('name' => 'City of Toronto Animal Services South Region', 'lat' => '43.6346687', 'long' => '-79.6967789'),
            'intake_date' => date("Y-m-d H:i:s", strtotime('12/06/2015')),
            'noise_level' => 1,
            'activity_level' => 2,
            'friend_level' => 5,
            'train_level' => 7,
            'health_level' => 9,
            'description' => 'This is a long description.',
            'excerpt' => 'This is an excerpt',
            'special_needs' => 'Some special needs',
        ));

        Dog::create(array(
        	'reference_num' => 'A700443',
            'name' => 'Spot',
            'age' => 5,
            'size' => 'small',
            'gender' => 'female',
            'breed' => 'Lhasa Apso mix',
            'color' => 'white',
            'declawed' => true,
            'neutered' => false,
            'location' => array('name' => 'City of Toronto Animal Services South Region', 'lat' => '43.6346687', 'long' => '-79.6967789'),
            'intake_date' => date("Y-m-d H:i:s", strtotime('05/12/2014')),
            'noise_level' => 7,
            'activity_level' => 8,
            'friend_level' => 2,
            'train_level' => 1,
            'health_level' => 1,
            'description' => 'This is a long description.',
            'excerpt' => 'This is an excerpt',
            'special_needs' => 'Some special needs',
        ));

        // Create dummy dogs
        factory(App\Dog::class, 50)->create();

    }
}
