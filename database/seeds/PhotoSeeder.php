<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'url' => 'https://st.depositphotos.com/1743476/1276/i/950/depositphotos_12764853-stock-photo-hairdressing.jpg',
        ]);
        DB::table('photos')->insert([
            'url' => 'https://static5.depositphotos.com/1049184/509/i/950/depositphotos_5099499-stock-photo-hairdresser-at-work.jpg',
        ]);
    }
}