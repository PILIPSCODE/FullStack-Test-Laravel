<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namaDepan = $this->faker->randomElement([
            'Budi', 'Siti', 'Agus', 'Dewi', 'Rizki', 'Andi', 'Fitri',
            'Hendra', 'Yuni', 'Dian', 'Fajar', 'Rini', 'Wahyu', 'Lestari',
            'Joko', 'Maya', 'Irwan', 'Nurul', 'Bagas', 'Ayu', 'Teguh',
            'Rani', 'Dimas', 'Intan', 'Surya', 'Wulan', 'Reza', 'Putri',
        ]);

        $namaBelakang = $this->faker->randomElement([
            'Santoso', 'Rahayu', 'Wibowo', 'Setiawan', 'Kusuma', 'Pratama',
            'Cahyani', 'Saputra', 'Hidayat', 'Permata', 'Nugroho', 'Kurniawan',
            'Laksono', 'Purnama', 'Susanto', 'Wijaya', 'Hartono', 'Utama',
            'Handayani', 'Maulana', 'Sulistyo', 'Ramadhan', 'Oktaviani',
        ]);

        $namaLengkap = $namaDepan . ' ' . $namaBelakang;
        $jabatanList = ['Manager', 'HR', 'IT'];

        return [
            'nama'          => $namaLengkap,
            'email'         => strtolower($namaDepan) . '.' . strtolower($namaBelakang) . $this->faker->unique()->numberBetween(1, 999) . '@company.co.id',
            'jabatan'       => $this->faker->randomElement($jabatanList),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-50 years', '-22 years')->format('Y-m-d'),
            'foto'          => null,
        ];
    }
}
