<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'corte de cabelo',
            'price' => '50.00',
        ]);

        DB::table('services')->insert([
            'name' => 'depilação',
            'price' => '33.00',
        ]);

        DB::table('services')->insert([
            'name' => 'unha',
            'price' => '22.00',
        ]);
    }
}