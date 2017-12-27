<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(MisterSeeder::class);
    }
}
