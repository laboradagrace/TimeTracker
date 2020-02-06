<?php

use Illuminate\Database\Seeder;

class nameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_infos')->insert([
            'name' => Str::random(10),
           
    }
}
