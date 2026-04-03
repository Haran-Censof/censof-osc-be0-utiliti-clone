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
     * Including: osc_usr_profile, osc_da_pelanggan, osc_da_individu/syarikat, osc_da_alamat
     */
    public function run(): void
    {
        $pbtCode = 'PRK_MDTM';

        $users = [
            [
                'ic_number' => '900101011234',
                'name' => 'AHMAD ENTERPRISE',
                'email' => 'ahmad.enterprise@gmail.com',
                'password' => 'Password123!',
                'jenis' => 'S', // Syarikat
                'phone' => '03-89876543',
                'mobile' => '012-3456789',
                'syarikat' => [
                    'ssm_no' => '202001012345',
                    'no_daftar_kew' => 'K-2020-001234',
                    'status_bumi' => 'Y',
                    'jenis_niaga' => 'Sdn Bhd',
                    'kategori' => 'B', // Bumiputera
                    'tarikh_mula' => '2020-01-15',
                    'wakil_nama' => 'Ahmad Bin Abdullah',
                    'wakil_ic' => '850101015555',
                    'wakil_jawatan' => 'Pengarah Urusan',
                ],
                'alamat' => [
                    'alamat1' => 'No. 45, Jalan Merdeka',
                    'alamat2' => 'Taman Melati',
                    'poskod' => '53100',
                    'bandar' => 'Kuala Lumpur',
                    'negeri' => 'Wilayah Persekutuan Kuala Lumpur',
                ],
            ],
            [
                'ic_number' => '900101010001',
                'name' => 'Siti Binti Ahmad',
                'email' => 'siti.ahmad@yahoo.com',
                'password' => 'Password123!',
                'jenis' => 'I', // Individu
                'phone' => '03-12345678',
                'mobile' => '019-8765432',
                'individu' => [
                    'jantina' => 'P',
                    'bangsa' => 'M',
                    'agama' => 'I',
                    'tarikh_lahir' => '1990-01-01',
                    'warganegara' => 'Y',
                    'status_kahwin' => 'K',
                ],
                'alamat' => [
                    'alamat1' => 'No. 12, Jalan Budiman',
                    'alamat2' => 'Taman Sri Rampai',
                    'poskod' => '53300',
                    'bandar' => 'Kuala Lumpur',
                    'negeri' => 'Wilayah Persekutuan Kuala Lumpur',
                ],
            ],
            [
                'ic_number' => '920515108899',
                'name' => 'Lee Wei Ming',
                'email' => 'leeweiming@hotmail.com',
                'password' => 'Password123!',
                'jenis' => 'I', // Individu
                'phone' => '04-2345678',
                'mobile' => '016-5551234',
                'individu' => [
                    'jantina' => 'L',
                    'bangsa' => 'C',
                    'agama' => 'B',
                    'tarikh_lahir' => '1992-05-15',
                    'warganegara' => 'Y',
                    'status_kahwin' => 'B',
                ],
                'alamat' => [
                    'alamat1' => 'No. 88, Lorong Harmoni 3',
                    'alamat2' => 'Taman Harmoni',
                    'poskod' => '31400',
                    'bandar' => 'Ipoh',
                    'negeri' => 'Perak',
                ],
            ],
        ];

        foreach ($users as $userData) {
            $icNumber = $userData['ic_number'];

            // 1. osc_usr_profile (login)
            $exists = DB::table('osc_usr_profile')
                ->where('pfile_kumpulan', 1)
                ->where('pfile_plgid', $icNumber)
                ->exists();

            if (!$exists) {
                DB::table('osc_usr_profile')->insert([
                    'pfile_kumpulan' => 1,
                    'pfile_jenis' => $userData['jenis'],
                    'pfile_plgid' => $icNumber,
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

            // 2. osc_da_pelanggan (customer record)
            $pelangganExists = DB::table('osc_da_pelanggan')
                ->where('plgn_idpelanggan', $icNumber)
                ->exists();

            if (!$pelangganExists) {
                DB::table('osc_da_pelanggan')->insert([
                    'plgn_idpbt' => $pbtCode,
                    'plgn_idpelanggan' => $icNumber,
                    'plgn_pelanggannama' => $userData['name'],
                    'plgn_pelangganjenis' => $userData['jenis'],
                    'plgn_idate' => now()->format('Y-m-d'),
                    'plgn_iuser' => 'SYSTEM',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 3. osc_da_individu / osc_da_syarikat (profile)
            if ($userData['jenis'] === 'I' && isset($userData['individu'])) {
                $indExists = DB::table('osc_da_individu')
                    ->where('indv_idpelanggan', $icNumber)
                    ->exists();

                if (!$indExists) {
                    $ind = $userData['individu'];
                    DB::table('osc_da_individu')->insert([
                        'indv_idpbt' => $pbtCode,
                        'indv_idpelanggan' => $icNumber,
                        'indv_jantina' => $ind['jantina'],
                        'indv_bangsa' => $ind['bangsa'],
                        'indv_agama' => $ind['agama'],
                        'indv_tarikhlahir' => $ind['tarikh_lahir'],
                        'indv_warganegara' => $ind['warganegara'],
                        'indv_stperkahwinan' => $ind['status_kahwin'],
                        'indv_idate' => now()->format('Y-m-d'),
                        'indv_iuser' => 'SYSTEM',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if ($userData['jenis'] === 'S' && isset($userData['syarikat'])) {
                $sykExists = DB::table('osc_da_syarikat')
                    ->where('sykt_idpelanggan', $icNumber)
                    ->exists();

                if (!$sykExists) {
                    $syk = $userData['syarikat'];
                    DB::table('osc_da_syarikat')->insert([
                        'sykt_idpbt' => $pbtCode,
                        'sykt_idpelanggan' => $icNumber,
                        'sykt_lhdnsstid' => $syk['ssm_no'],
                        'sykt_nodaftarkew' => $syk['no_daftar_kew'],
                        'sykt_statusbumi' => $syk['status_bumi'],
                        'sykt_jenisniaga' => $syk['jenis_niaga'],
                        'sykt_kategori' => $syk['kategori'],
                        'sykt_tkhmulaniaga' => $syk['tarikh_mula'],
                        'sykt_authorizedname' => $syk['wakil_nama'],
                        'sykt_authorizedic' => $syk['wakil_ic'],
                        'sykt_authorizedjawatan' => $syk['wakil_jawatan'],
                        'sykt_idate' => now()->format('Y-m-d'),
                        'sykt_iuser' => 'SYSTEM',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // 4. osc_da_alamat (address)
            if (isset($userData['alamat'])) {
                $almtExists = DB::table('osc_da_alamat')
                    ->where('almt_idpelanggan', $icNumber)
                    ->exists();

                if (!$almtExists) {
                    $almt = $userData['alamat'];
                    DB::table('osc_da_alamat')->insert([
                        'almt_idpbt' => $pbtCode,
                        'almt_idpelanggan' => $icNumber,
                        'almt_alamatid' => 1,
                        'almt_alamat01' => $almt['alamat1'],
                        'almt_alamat02' => $almt['alamat2'],
                        'almt_poskod' => $almt['poskod'],
                        'almt_alamat04' => $almt['bandar'],
                        'almt_alamat05' => $almt['negeri'],
                        'almt_nomborhp' => $userData['mobile'],
                        'almt_notelefon' => $userData['phone'],
                        'almt_email' => $userData['email'],
                        'almt_jenis' => 'R', // Rumah/Residential
                        'almt_default' => true,
                        'almt_idate' => now()->format('Y-m-d'),
                        'almt_iuser' => 'SYSTEM',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
