<?php

use Illuminate\Database\Seeder;

class MisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('misters')->insert([
            'name' => 'Javier',
            'email' => str_random(10).'@gmail.com',
            'username' => 'mister',
            'password' => bcrypt('prueba'),
            'club_id' => '1'
        ]);
    }
}
