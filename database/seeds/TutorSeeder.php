<?php

use Illuminate\Database\Seeder;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tutors')->insert([
            'name' => 'Lova',
            'email' => 'ignacioduraperez@hotmail.com',
            'username' => 'tutor',
            'player_id' => 1
        ]);
    }
}
