<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // Data pegawai tetap (fixed dummy data)
        $pegawaiTetap = [
            ['nama' => 'Budi Santoso',    'email' => 'budi.santoso@company.co.id',    'jabatan' => 'Manager', 'tanggal_lahir' => '1985-03-15'],
            ['nama' => 'Siti Rahayu',     'email' => 'siti.rahayu@company.co.id',     'jabatan' => 'HR',      'tanggal_lahir' => '1990-07-22'],
            ['nama' => 'Agus Wibowo',     'email' => 'agus.wibowo@company.co.id',     'jabatan' => 'IT',      'tanggal_lahir' => '1992-11-08'],
            ['nama' => 'Dewi Permata',    'email' => 'dewi.permata@company.co.id',    'jabatan' => 'HR',      'tanggal_lahir' => '1988-05-30'],
            ['nama' => 'Rizki Pratama',   'email' => 'rizki.pratama@company.co.id',   'jabatan' => 'Manager', 'tanggal_lahir' => '1983-12-01'],
            ['nama' => 'Nurul Hidayat',   'email' => 'nurul.hidayat@company.co.id',   'jabatan' => 'IT',      'tanggal_lahir' => '1995-02-17'],
            ['nama' => 'Fajar Kurniawan', 'email' => 'fajar.kurniawan@company.co.id', 'jabatan' => 'IT',      'tanggal_lahir' => '1994-09-25'],
            ['nama' => 'Intan Lestari',   'email' => 'intan.lestari@company.co.id',   'jabatan' => 'HR',      'tanggal_lahir' => '1991-06-14'],
            ['nama' => 'Wahyu Nugroho',   'email' => 'wahyu.nugroho@company.co.id',   'jabatan' => 'Manager', 'tanggal_lahir' => '1980-08-03'],
            ['nama' => 'Ayu Purnama',     'email' => 'ayu.purnama@company.co.id',     'jabatan' => 'IT',      'tanggal_lahir' => '1996-04-19'],
        ];

        foreach ($pegawaiTetap as $pegawai) {
            Pegawai::firstOrCreate(
                ['email' => $pegawai['email']],
                array_merge($pegawai, ['foto' => null])
            );
        }

        // Tambahan 20 data acak menggunakan Factory
        Pegawai::factory(20)->create();

        $this->command->info('✅ PegawaiSeeder berhasil: 10 data tetap + 20 data acak telah dibuat.');
    }
}
