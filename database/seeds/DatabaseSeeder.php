<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
        $this->call(PhotoSeeder::class);
        $this->call(PhotoUsuarioSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}