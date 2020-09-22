<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photo_usuario')->insert([
            'usuario_id' => '1',
            'service_id' => '1',
        ]);

        DB::table('photo_usuario')->insert([
            'usuario_id' => '1',
            'service_id' => '2',
        ]);
    }
}