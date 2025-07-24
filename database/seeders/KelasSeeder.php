<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasData = [
            [
                'matakuliah_id' => 1,
                'user_id' => 1, // dosen pengampu
                'tahun_ajaran' => '2024-2025',
                'nama_kelas' => 'Pemrograman Web A',
            ],
            [
                'matakuliah_id' => 2,
                'user_id' => 2,
                'tahun_ajaran' => '2024-2025',
                'nama_kelas' => 'Database Management B',
            ],
            [
                'matakuliah_id' => 3,
                'user_id' => 1,
                'tahun_ajaran' => '2024-2025',
                'nama_kelas' => 'Algoritma dan Struktur Data A',
            ],
            [
                'matakuliah_id' => 3,
                'user_id' => 1,
                'tahun_ajaran' => '2024-2025',
                'nama_kelas' => 'Sistem Operasi A',
            ],
            [
                'matakuliah_id' => 1,
                'user_id' => 2,
                'tahun_ajaran' => '2023-2024',
                'nama_kelas' => 'Pemrograman Web B',
            ],
        ];

        foreach ($kelasData as $data) {
            kelas::create($data);
        }
    }
}
