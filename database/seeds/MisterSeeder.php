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
            'name' => 'Mou',
            'email' => 'titomou@gmail.com',
            'username' => 'mister',
            'password' => bcrypt('prueba'),
            'team_id' => rand(1,2),
        ]);
    }
}
