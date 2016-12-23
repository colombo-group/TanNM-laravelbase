<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([ //,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password'=>bcrypt($faker->text($maxNbChars = 8)),
                'address' => $faker->address,
                'sex'=>'girl',
                'birthday'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                'slogan'=>$faker->text($maxNbChars = 200) 
            ]);
        }
    }
}
