<?php

namespace Database\Seeders;

use App\Models\InternalUser;
use Illuminate\Database\Seeder;

class InternalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_id' => 'USR000000001',
                'user_name' => '990101010001',
                'user_email' => 'admin.jkt@sample.com',
                'full_name' => 'Admin JKT',
                'role' => 'JKT',
                'majlis_code' => null,
            ],
            [
                'user_id' => 'USR000000002',
                'user_name' => '990101010002',
                'user_email' => 'admin.pbt@sample.com',
                'full_name' => 'Admin PBT Kuala Lumpur',
                'role' => 'PBT',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000003',
                'user_name' => '990101010003',
                'user_email' => 'admin.atl@sample.com',
                'full_name' => 'Admin ATL',
                'role' => 'ATL',
                'majlis_code' => null,
            ],
            [
                'user_id' => 'USR000000004',
                'user_name' => '990101010004',
                'user_email' => 'admin.btd@sample.com',
                'full_name' => 'Admin BTD',
                'role' => 'BTD',
                'majlis_code' => null,
            ],
            [
                'user_id' => 'USR000000005',
                'user_name' => '990101010005',
                'user_email' => 'admin.pbt2@sample.com',
                'full_name' => 'PPT PBT',
                'role' => 'PBT-PPT',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000006',
                'user_name' => '990101010006',
                'user_email' => 'admin.pbt3@sample.com',
                'full_name' => 'PENYEMAK PBT',
                'role' => 'PBT-PENYEMAK',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000007',
                'user_name' => '990101010007',
                'user_email' => 'admin.atl2@sample.com',
                'full_name' => 'ATL PENYEMAK',
                'role' => 'ATL-PENYEMAK',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000008',
                'user_name' => '990101010008',
                'user_email' => 'admin.btd2@sample.com',
                'full_name' => 'BTD PENYEMAK',
                'role' => 'BTD-PENYEMAK',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000009',
                'user_name' => '990101010009',
                'user_email' => 'admin.atl3@sample.com',
                'full_name' => 'ATL KETUA-JABATAN',
                'role' => 'ATL-KETUA-JABATAN',
                'majlis_code' => '0140',
            ],
            [
                'user_id' => 'USR000000010',
                'user_name' => '990101010010',
                'user_email' => 'admin.btd3@sample.com',
                'full_name' => 'BTD KETUA-JABATAN',
                'role' => 'BTD-KETUA-JABATAN',
                'majlis_code' => '0140',
            ],
        ];

        foreach ($users as $userData) {
            if (InternalUser::where('user_id', $userData['user_id'])->exists()) {
                $this->command?->warn("User {$userData['full_name']} ({$userData['user_id']}) already exists. Skipping.");
                continue;
            }

            InternalUser::create([
                'user_id' => $userData['user_id'],
                'user_name' => $userData['user_name'],
                'user_email' => $userData['user_email'],
                'user_password' => 'Password123!',
                'user_group_id' => 'STAFF',
                'user_status' => 'A',
                'full_name' => $userData['full_name'],
                'role' => $userData['role'],
                'majlis_code' => $userData['majlis_code'],
                'force_password_reset' => false,
                'user_created' => now(),
                'user_iuser' => 'SYSTEM',
            ]);

            $this->command?->info("Created user: {$userData['full_name']} (Role: {$userData['role']})");
        }
    }
}
