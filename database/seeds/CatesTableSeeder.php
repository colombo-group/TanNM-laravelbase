<?php

use Illuminate\Database\Seeder;

class CatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('cates')->insert([
             	'title' => 'Công nghệ',
                'parent_id'=>'0' 
            ]);
        DB::table('cates')->insert([
             	'title' => 'Moblile',
                'parent_id'=>'1' 
            ]); 
        DB::table('cates')->insert([
             	'title' => 'Laptop',
                'parent_id'=>'2' 
            ]); 
        DB::table('cates')->insert([
             	'title' => 'Internet',
                'parent_id'=>'0' 
            ]); 
        DB::table('cates')->insert([
             	'title' => 'Facebook',
                'parent_id'=>'1' 
            ]); 
        DB::table('cates')->insert([
             	'title' => 'Instagram',
                'parent_id'=>'1' 
            ]);
    }
}
