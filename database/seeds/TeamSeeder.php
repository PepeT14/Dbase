<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('teams')->insert([
           'name' => 'Alevin A',
           'league_id' =>  '1',
            'club_id' => '1'
         ]);
    }
}
