<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\krs;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $krsData = [
            [
                'user_id' => 3, // mahasiswa
                'kelas_id' => 1,
                'nilai_huruf' => 'A',
                'nilai_angka' => 85.5,
                'tahun_akademik' => '2025-2026',
                'status' => 'Disetujui',
            ],
            [
                'user_id' => 3,
                'kelas_id' => 2,
                'nilai_huruf' => 'B+',
                'nilai_angka' => 78.0,
                'tahun_akademik' => '2025-2026',
                'status' => 'Disetujui',
            ],
            [
                'user_id' => 4, // mahasiswa lain
                'kelas_id' => 1,
                'nilai_huruf' => 'B',
                'nilai_angka' => 75.5,
                'tahun_akademik' => '2025-2026',
                'status' => 'Disetujui',
            ],
            [
                'user_id' => 4,
                'kelas_id' => 3,
                'nilai_huruf' => null,
                'nilai_angka' => null,
                'tahun_akademik' => '2025-2026',
                'status' => 'Disetujui',
            ],
            [
                'user_id' => 4,
                'kelas_id' => 2,
                'nilai_huruf' => 'C',
                'nilai_angka' => 65.0,
                'tahun_akademik' => '2024-2025',
                'status' => 'Disetujui',
            ],
            [
                'user_id' => 4,
                'kelas_id' => 4,
                'nilai_huruf' => null,
                'nilai_angka' => null,
                'tahun_akademik' => '2025-2026',
                'status' => 'Tidak Disetujui',
            ],
        ];

        foreach ($krsData as $data) {
            krs::create($data);
        }
    }
}
