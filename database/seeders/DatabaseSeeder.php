<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Julius',
            'email' => 'jull@fic16.com',
            'password' => Hash::make('password123'),
        ]);

        // data dummy for Company
        Company::create([
            'name' => 'PT. FIC16',
            'email' => 'company@fic16.com',
            'address' => 'Jl. Raya Bogor, No. 16, Jakarta',
            'latitude' => '-6.200000',
            'longitude' => '106.816666',
            'radius_km' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00',
            ]);

        $this->call([
            AttendanceSeeder::class,
        ]);
    }
}
