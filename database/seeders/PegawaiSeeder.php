<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('pegawais')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'jabatan' => $faker->randomElement(['IT', 'HR', 'Manager']),
                'tanggal_lahir' => $faker->date(),
                'foto' => 'pegawai/th.jpeg', // Foto default
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
