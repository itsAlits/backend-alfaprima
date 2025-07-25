<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dosen User
        User::create([
            'name' => 'Prof. Dr. Rama Wijaya', //org keren
            'email' => 'rama.wijaya@alfaprima.com',
            'password' => bcrypt('password'),
            'nim_nip' => 'DSN001',
            'phone_number' => '081234567890',
            'address' => 'Jl. Panjer No. 1, Denpasar',
            'birth_date' => '2003-01-01',
            'gender' => 'Laki-laki',
            'religion' => 'Hindu',
            'profile_picture' => null,
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Widia Pratama, S.Kom., M.Kom.',
            'email' => 'widia.pratama@alfaprima.com',
            'password' => bcrypt('password'),
            'nim_nip' => 'DSN002',
            'phone_number' => '081234567891',
            'address' => 'Jl. Kedokteran No. 10, Jimbaran',
            'birth_date' => '2002-05-15',
            'gender' => 'Laki-laki',
            'religion' => 'Hindu',
            'profile_picture' => null,
            'role_id' => 2,
        ]);
        
        // Mahasiswa Users
        User::create([
            'nim_nip' => '2025001',
            'name' => 'Hana',
            'email' => 'hana@alfaprima.com',
            'password' => bcrypt('password'),
            'phone_number' => '081234567892',
            'address' => 'Jl. Dekat Gacoan No. 20, Jimbaran',
            'birth_date' => '2003-08-22',
            'gender' => 'Perempuan',
            'religion' => 'Katolik',
            'profile_picture' => null,
            'role_id' => 3,
        ]);

        User::create([
            'nim_nip' => '2025002',
            'name' => 'Ngakan Made Alit Wiradhanta',
            'email' => 'alitwira08@alfaprima.com',
            'password' => bcrypt('password'),
            'phone_number' => '081234567893',
            'address' => 'Jl. Tunggak Bingin No. 30, Sanur',
            'birth_date' => '2003-12-10',
            'gender' => 'Laki-laki',
            'religion' => 'Hindu',
            'profile_picture' => null,
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Dewi Ayu',
            'email' => 'DewiAyu@alfaprima.com',
            'password' => bcrypt('password'),
            'nim_nip' => '2025003',
            'phone_number' => '081234567323',
            'address' => 'Jl. Tunggak Bingin No. 30, Pejeng',
            'birth_date' => '2003-12-10',
            'gender' => 'Laki-laki',
            'religion' => 'Islam',
            'profile_picture' => null,
            'role_id' => 3,
        ]);
    }
}
