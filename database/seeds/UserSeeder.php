<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'totalTimeWorked' => Str::random(10),
        	'hoursLeft'=> Str::random(10),
        	'totalBreaksUsed'=> Str::random(10)
           	
        ]);
    }
}
