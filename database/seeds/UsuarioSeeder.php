<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('usuarios')->insert([
            'name' => 'wesllen alves de sousa',
            'email' => 'wesllenalves@gmail.com',
            'password' => Hash::make('Br241993'),
            'avatar' => 'https://st.depositphotos.com/2251265/2417/i/950/depositphotos_24172293-stock-photo-faceless-person-portrait.jpg',
            'stars' => '4.3'
        ]);

        for ($i = 0; $i < 15; $i++) {
            DB::table('usuarios')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'avatar' => 'https://st.depositphotos.com/2251265/2417/i/950/depositphotos_24172293-stock-photo-faceless-person-portrait.jpg',
                'stars' => '4.3'
            ]);
        }

    }
}