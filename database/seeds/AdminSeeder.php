<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_clubs')->insert([
            'email' => str_random(10).'@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('prueba'),
            'club_id' => '1'
        ]);
    }
}
