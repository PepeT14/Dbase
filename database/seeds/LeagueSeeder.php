<?php

use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('leagues')->insert([
            'name' => 'Tercera Andaluza',
            'state' => 'Andalucía',
            'province' => 'Cádiz',
            'category' => 'Alevín',
        ]);
    }
}
