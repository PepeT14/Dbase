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
            'name' => 'A.D Marianistas C',
            'league_id' => '1',
            'club_id' => '2',
            'category' => 'Pre-Benjamin'
        ]);
        DB::table('teams')->insert([
            'name' => 'Paquete U.D B',
            'league_id' => '1',
            'club_id' => '1',
            'category' => 'Pre-Benjamin'
        ]);


    }
}
