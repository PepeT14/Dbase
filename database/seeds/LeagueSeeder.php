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

        $categorias = array('prebenjamin','benjamin','alevin','infantil','cadete','juvenil');

        for($i = 0;$i<count($categorias);$i++){
            DB::table('leagues')->insert([
                ['name' => '3ª andaluza','state'=>'andalucia','province'=>'cadiz','category'=>$categorias[$i]],
                ['name' => '2ª andaluza','state' =>'andalucia','province'=>'cadiz','category'=>$categorias[$i]]
            ]);
            if($i != 0){
                DB::table('leagues')->insert([
                   ['name'=>'4ª andaluza','state'=>'andalucia','province'=>'cadiz','category'=>$categorias[$i]]
                ]);
            }
        }
        //

        //PARTIDOS
        DB::table('matchs')->insert([
            ['jornada'=>1,'title'=>'Paquete U.D A - Paquete U.D B','start'=>'2018-01-27 10:00','end' => '2018-01-27 12:00','league_id' => 1]
        ]);

    }
}
