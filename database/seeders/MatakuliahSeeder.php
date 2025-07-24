<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matakuliah::create([
            'kode_matakuliah' => 'IF101',
            'nama_matakuliah' => 'Algoritma dan Pemrograman',
            'sks' => 3,
            'semester' => 1,
        ]);

        Matakuliah::create([
            'kode_matakuliah' => 'IF102',
            'nama_matakuliah' => 'Struktur Data',
            'sks' => 3,
            'semester' => 1,
        ]);

        Matakuliah::create([
            'kode_matakuliah' => 'IF103',
            'nama_matakuliah' => 'Basis Data',
            'sks' => 3,
            'semester' => 1,
        ]);
    }
}
