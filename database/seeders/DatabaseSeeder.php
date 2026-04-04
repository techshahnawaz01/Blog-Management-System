<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Is factory wali line ko comment kar dein ya hata dein
        // \App\Models\User::factory(10)->create(); 

        // Sirf is call ko active rakhein
        $this->call([
            UserSeeder::class,
        ]);
    }
}
