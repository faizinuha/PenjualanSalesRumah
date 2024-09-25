<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'rtxalham@gmail.com'], // Kondisi pencocokan
            [
                'name' => 'Mihari',
                'password' => Hash::make('as'),
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'rozakadm@gmail.com'], // Kondisi pencocokan
            [
                'name' => 'Mahiro',
                'password' => Hash::make('as'),
            ]
        );
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
