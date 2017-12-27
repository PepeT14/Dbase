<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('super_admins')->insert([
            'username' => 'dios',
            'password' => bcrypt('prueba')
            ]);
    }
}
