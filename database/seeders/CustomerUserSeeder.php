<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seeds customer users for fe-customer login
     */
    public function run(): void
    {
        $users = [
            [
                'ic_number' => '900101011234',
                'name' => 'AHMAD ENTERPRISE',
                'email' => 'ahmad.abdullah@gmail.com',
                'password' => 'password',
                'jenis' => 'S', // Syarikat
            ],
            [
                'ic_number' => '900101010001',
                'name' => 'Siti Binti Ahmad',
                'email' => 'siti.ahmad@yahoo.com',
                'password' => 'password',
                'jenis' => 'I', // Individu
            ],
            [
                'ic_number' => '920515108899',
                'name' => 'Lee Wei Ming',
                'email' => 'leeweiming@hotmail.com',
                'password' => 'password',
                'jenis' => 'I', // Individu
            ],
        ];

        foreach ($users as $userData) {
            $exists = DB::table('osc_usr_profile')
                ->where('pfile_kumpulan', 1)
                ->where('pfile_plgid', $userData['ic_number'])
                ->exists();

            if ($exists) {
                $this->command->warn("User {$userData['name']} (IC: {$userData['ic_number']}) already exists. Skipping.");
                continue;
            }

            // Insert into osc_usr_profile table
            DB::table('osc_usr_profile')->insert([
                'pfile_kumpulan' => 1,
                'pfile_jenis' => $userData['jenis'] ?? 'I',
                'pfile_plgid' => $userData['ic_number'],
                'pfile_nama' => $userData['name'],
                'pfile_emel' => $userData['email'],
                'pfile_kata_laluan' => Hash::make($userData['password']),
                'pfile_statpemohon' => 'Y',
                'pfile_warganegara' => 'Y',
                'pfile_idate' => now()->format('Y-m-d'),
                'pfile_iuser' => 'SYSTEM',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
