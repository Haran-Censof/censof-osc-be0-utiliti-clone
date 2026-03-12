<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Renewal Sample Data Seeder
 *
 * Creates sample license and renewal data for the test customer (900101010001).
 * This seeder provides realistic renewal scenarios for development and testing.
 *
 * Run: php artisan db:seed --class=RenewalSampleDataSeeder
 *
 * Data created:
 * - 1 customer record (osc_da_pelanggan)
 * - 11 licenses (osc_ind_induklesen) with various expiry scenarios
 * - 11 business code records (osc_ind_translesen)
 * - 5 advertisement records (osc_ind_iklanlesen)
 * - 11 worker records (osc_ind_lpekerja)
 * - 4 nominee records (osc_ind_lnomini)
 * - 7 renewal records (renewals) in all statuses: initiated, submitted, under_review, approved, rejected, completed
 * - 5 renewal applications (osc_mhn_permohonan) with related data
 * - 4 billing records (osc_bil_invois) for submitted/completed/rejected renewals
 */
class RenewalSampleDataSeeder extends Seeder
{
    private string $testCustomerId = '900101010001';
    private string $pbtCode = 'PRK_MDTM';
    private int $baseAccount = 90001;

    public function run(): void
    {
        $this->command->info('Seeding renewal sample data for test customer: ' . $this->testCustomerId);

        $this->createCustomer();
        $licenseIds = $this->createLicenses();
        $this->createBusinessCodes();
        $this->createAdvertisements();
        $this->createWorkers();
        $this->createNominees();
        $this->createRenewals($licenseIds);
        $appIds = $this->createRenewalApplications($licenseIds);
        $this->createApplicationRelatedData($appIds);
        $this->createBillingRecords($appIds);

        $this->command->info('Renewal sample data seeded successfully.');
    }

    private function createCustomer(): void
    {
        DB::table('osc_da_pelanggan')->updateOrInsert(
            ['plgn_idpelanggan' => $this->testCustomerId],
            [
                'plgn_pelanggannama' => 'AHMAD BIN ALI',
                'plgn_pelangganjenis' => 'I',
                'plgn_tinid' => $this->testCustomerId,
                'plgn_idpbt' => $this->pbtCode,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Create login credential in osc_usr_profile (for FE Customer login)
        DB::table('osc_usr_profile')->updateOrInsert(
            ['pfile_plgid' => $this->testCustomerId],
            [
                'pfile_nama' => 'AHMAD BIN ALI',
                'pfile_emel' => 'ahmad@test.com',
                'pfile_kata_laluan' => Hash::make('Password123!'),
                'pfile_nomhp' => '0125551234',
                'pfile_jenis' => 'I',
                'pfile_warganegara' => 'M',
                'pfile_statpemohon' => 'A',
                'pfile_idate' => Carbon::now()->format('Y-m-d'),
                'pfile_iuser' => 'SYSTEM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $this->command->info('Created customer record and login credential.');
    }

    private function createLicenses(): array
    {
        $now = Carbon::now();

        $licenses = [
            [
                'ind_akaun' => $this->baseAccount,
                'ind_namaperniagaan' => 'RESTORAN NASI KANDAR PELITA',
                'ind_almtperniagaan1' => 'NO 12, JALAN SULTAN IDRIS SHAH, IPOH',
                'ind_norujukan' => 'LIC/2024/R001',
                'ind_kodlokasi' => 23,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(30)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 1,
                'ind_namaperniagaan' => 'KEDAI GUNTING RAMBUT AHMAD',
                'ind_almtperniagaan1' => 'NO 45, JALAN DATO MAHARAJALELA, IPOH',
                'ind_norujukan' => 'LIC/2024/R002',
                'ind_kodlokasi' => 35,
                'ind_katniaga' => 2,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(15)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 2,
                'ind_namaperniagaan' => 'BENGKEL KERETA JAYA MOTOR',
                'ind_almtperniagaan1' => 'LOT 88, KAWASAN PERINDUSTRIAN, IPOH',
                'ind_norujukan' => 'LIC/2024/R003',
                'ind_kodlokasi' => 10,
                'ind_katniaga' => 3,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(60)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 3,
                'ind_namaperniagaan' => 'PASAR MINI SEJAHTERA',
                'ind_almtperniagaan1' => 'NO 99, JALAN GOPENG, IPOH',
                'ind_norujukan' => 'LIC/2024/R004',
                'ind_kodlokasi' => 50,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->subDays(10)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 4,
                'ind_namaperniagaan' => 'KAFE SELERA TIMUR',
                'ind_almtperniagaan1' => 'NO 7, JALAN RAJA PERMAISURI BAINUN, IPOH',
                'ind_norujukan' => 'LIC/2024/R005',
                'ind_kodlokasi' => 23,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(5)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 5,
                'ind_namaperniagaan' => 'FARMASI AL-IMAN SDN BHD',
                'ind_almtperniagaan1' => 'NO 33, JALAN CM YUSUF, IPOH',
                'ind_norujukan' => 'LIC/2025/R006',
                'ind_kodlokasi' => 15,
                'ind_katniaga' => 4,
                'ind_jenisplg' => 'S',
                'ind_tkhtamat' => $now->copy()->addDays(180)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 6,
                'ind_namaperniagaan' => 'PUSAT TUISYEN CEMERLANG',
                'ind_almtperniagaan1' => 'NO 55, JALAN TAMBUN, IPOH',
                'ind_norujukan' => 'LIC/2024/R007',
                'ind_kodlokasi' => 40,
                'ind_katniaga' => 5,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(20)->format('Y-m-d'),
            ],
            [
                'ind_akaun' => $this->baseAccount + 7,
                'ind_namaperniagaan' => 'KEDAI ELEKTRIK JAYA',
                'ind_almtperniagaan1' => 'NO 101, JALAN PASIR PUTEH, IPOH',
                'ind_norujukan' => 'LIC/2024/R008',
                'ind_kodlokasi' => 23,
                'ind_katniaga' => 2,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(180)->format('Y-m-d'),
            ],
            // License 9 - under_review renewal scenario
            [
                'ind_akaun' => $this->baseAccount + 8,
                'ind_namaperniagaan' => 'KEDAI RUNCIT BARAKAH',
                'ind_almtperniagaan1' => 'NO 22, JALAN DATO ONN JAAFAR, IPOH',
                'ind_norujukan' => 'LIC/2024/R009',
                'ind_kodlokasi' => 23,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->addDays(10)->format('Y-m-d'),
            ],
            // License 10 - rejected renewal scenario
            [
                'ind_akaun' => $this->baseAccount + 9,
                'ind_namaperniagaan' => 'SALON KECANTIKAN DIVA',
                'ind_almtperniagaan1' => 'NO 66, JALAN SULTAN AZLAN SHAH, IPOH',
                'ind_norujukan' => 'LIC/2024/R010',
                'ind_kodlokasi' => 35,
                'ind_katniaga' => 2,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->subDays(5)->format('Y-m-d'),
            ],
            // License 11 - expired beyond grace period (not eligible)
            [
                'ind_akaun' => $this->baseAccount + 10,
                'ind_namaperniagaan' => 'WARUNG MAKAN PAK ALI',
                'ind_almtperniagaan1' => 'NO 3, JALAN KUALA KANGSAR, IPOH',
                'ind_norujukan' => 'LIC/2024/R011',
                'ind_kodlokasi' => 50,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkhtamat' => $now->copy()->subDays(45)->format('Y-m-d'),
            ],
        ];

        $insertedIds = [];
        foreach ($licenses as $license) {
            $startDate = $now->copy()->subYear();
            $id = DB::table('osc_ind_induklesen')->insertGetId(array_merge($license, [
                'ind_idpbt' => $this->pbtCode,
                'ind_idpelanggan' => $this->testCustomerId,
                'ind_nosiri' => $license['ind_akaun'],
                'ind_tkhmohon' => $startDate->format('Y-m-d'),
                'ind_tkhlulus' => $startDate->copy()->addDays(14)->format('Y-m-d'),
                'ind_statl' => 'B',
                'ind_tkhmula' => $startDate->format('Y-m-d'),
                'ind_tempoh' => 12,
                'ind_tkhmsyuarat' => $startDate->format('Y-m-d'),
                'ind_notelefon' => '012555' . str_pad($license['ind_akaun'] - $this->baseAccount + 1, 4, '0', STR_PAD_LEFT),
                'ind_idate' => $startDate->format('Y-m-d'),
                'ind_iuser' => 'SYSTEM',
            ]));
            $insertedIds[] = $id;
        }

        $this->command->info('Created ' . count($insertedIds) . ' license records.');
        return $insertedIds;
    }

    private function createBusinessCodes(): void
    {
        $codes = [
            ['trn_akaun' => 90001, 'trn_kodniaga' => '0100101', 'trn_kodniaga1' => '01', 'trn_kodniaga2' => '001', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90002, 'trn_kodniaga' => '0200101', 'trn_kodniaga1' => '02', 'trn_kodniaga2' => '001', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90003, 'trn_kodniaga' => '0300201', 'trn_kodniaga1' => '03', 'trn_kodniaga2' => '002', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90004, 'trn_kodniaga' => '0100302', 'trn_kodniaga1' => '01', 'trn_kodniaga2' => '003', 'trn_kodniaga3' => '02'],
            ['trn_akaun' => 90005, 'trn_kodniaga' => '0100103', 'trn_kodniaga1' => '01', 'trn_kodniaga2' => '001', 'trn_kodniaga3' => '03'],
            ['trn_akaun' => 90006, 'trn_kodniaga' => '0400401', 'trn_kodniaga1' => '04', 'trn_kodniaga2' => '004', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90007, 'trn_kodniaga' => '0500501', 'trn_kodniaga1' => '05', 'trn_kodniaga2' => '005', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90008, 'trn_kodniaga' => '0200202', 'trn_kodniaga1' => '02', 'trn_kodniaga2' => '002', 'trn_kodniaga3' => '02'],
            ['trn_akaun' => 90009, 'trn_kodniaga' => '0100102', 'trn_kodniaga1' => '01', 'trn_kodniaga2' => '001', 'trn_kodniaga3' => '02'],
            ['trn_akaun' => 90010, 'trn_kodniaga' => '0200301', 'trn_kodniaga1' => '02', 'trn_kodniaga2' => '003', 'trn_kodniaga3' => '01'],
            ['trn_akaun' => 90011, 'trn_kodniaga' => '0100101', 'trn_kodniaga1' => '01', 'trn_kodniaga2' => '001', 'trn_kodniaga3' => '01'],
        ];

        foreach ($codes as $code) {
            DB::table('osc_ind_translesen')->insert(array_merge($code, [
                'trn_idpbt' => $this->pbtCode,
                'trn_sequtama' => 1,
                'trn_stattrans' => 'A',
                'trn_idate' => Carbon::now()->subYear()->format('Y-m-d'),
                'trn_iuser' => 'SYSTEM',
                'created_at' => now(),
            ]));
        }

        $this->command->info('Created 11 business code records.');
    }

    private function createAdvertisements(): void
    {
        $ads = [
            ['lan_akaun' => 90001, 'lan_rujukan' => 'IKL/2024/001', 'lan_amaun' => 120.00],
            ['lan_akaun' => 90004, 'lan_rujukan' => 'IKL/2024/002', 'lan_amaun' => 200.00],
            ['lan_akaun' => 90005, 'lan_rujukan' => 'IKL/2024/003', 'lan_amaun' => 150.00],
            ['lan_akaun' => 90006, 'lan_rujukan' => 'IKL/2024/004', 'lan_amaun' => 300.00],
            ['lan_akaun' => 90007, 'lan_rujukan' => 'IKL/2024/005', 'lan_amaun' => 100.00],
        ];

        $now = Carbon::now();
        foreach ($ads as $ad) {
            DB::table('osc_ind_iklanlesen')->insert(array_merge($ad, [
                'lan_idpbt' => $this->pbtCode,
                'lan_tkhmula' => $now->copy()->subYear()->format('Y-m-d'),
                'lan_tkhtmt' => $now->copy()->addDays(30)->format('Y-m-d'),
                'lan_lentang' => 'M',
            ]));
        }

        $this->command->info('Created 5 advertisement records.');
    }

    private function createWorkers(): void
    {
        if (!DB::getSchemaBuilder()->hasTable('osc_ind_lpekerja')) {
            $this->command->warn('Table osc_ind_lpekerja does not exist, skipping license worker records.');
            return;
        }

        $workers = [
            ['lpk_akaun' => 90001, 'lpk_melayu' => 5, 'lpk_cina' => 2, 'lpk_india' => 1, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90002, 'lpk_melayu' => 2, 'lpk_cina' => 0, 'lpk_india' => 0, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90003, 'lpk_melayu' => 3, 'lpk_cina' => 1, 'lpk_india' => 1, 'lpk_lainlain' => 1],
            ['lpk_akaun' => 90004, 'lpk_melayu' => 4, 'lpk_cina' => 3, 'lpk_india' => 1, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90005, 'lpk_melayu' => 3, 'lpk_cina' => 1, 'lpk_india' => 0, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90006, 'lpk_melayu' => 2, 'lpk_cina' => 1, 'lpk_india' => 1, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90007, 'lpk_melayu' => 6, 'lpk_cina' => 2, 'lpk_india' => 0, 'lpk_lainlain' => 1],
            ['lpk_akaun' => 90008, 'lpk_melayu' => 2, 'lpk_cina' => 0, 'lpk_india' => 1, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90009, 'lpk_melayu' => 3, 'lpk_cina' => 2, 'lpk_india' => 0, 'lpk_lainlain' => 0],
            ['lpk_akaun' => 90010, 'lpk_melayu' => 2, 'lpk_cina' => 0, 'lpk_india' => 0, 'lpk_lainlain' => 1],
            ['lpk_akaun' => 90011, 'lpk_melayu' => 4, 'lpk_cina' => 1, 'lpk_india' => 1, 'lpk_lainlain' => 0],
        ];

        foreach ($workers as $worker) {
            DB::table('osc_ind_lpekerja')->insert(array_merge($worker, [
                'lpk_idpbt' => $this->pbtCode,
                'lpk_idate' => Carbon::now()->subYear()->format('Y-m-d'),
                'lpk_iuser' => 'SYSTEM',
            ]));
        }

        $this->command->info('Created 11 worker records.');
    }

    private function createNominees(): void
    {
        if (!DB::getSchemaBuilder()->hasTable('osc_ind_lnomini')) {
            $this->command->warn('Table osc_ind_lnomini does not exist, skipping license nominee records.');
            return;
        }

        $nominees = [
            [
                'nom_akaun' => 90001,
                'nom_idplgnom1' => '880101010001',
                'nom_namanom1' => 'MOHD RAZIF BIN YUSOF',
                'nom_trkhtmt1' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nom_akaun' => 90004,
                'nom_idplgnom1' => '870202020002',
                'nom_namanom1' => 'TAN AH KOW',
                'nom_trkhtmt1' => Carbon::now()->addMonths(6)->format('Y-m-d'),
            ],
            [
                'nom_akaun' => 90005,
                'nom_idplgnom1' => '850303030003',
                'nom_namanom1' => 'SITI HAJAR BINTI AHMAD',
                'nom_trkhtmt1' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nom_akaun' => 90006,
                'nom_idplgnom1' => '860404040004',
                'nom_namanom1' => 'DR. FARAH BINTI IBRAHIM',
                'nom_trkhtmt1' => Carbon::now()->addMonths(8)->format('Y-m-d'),
            ],
        ];

        foreach ($nominees as $nominee) {
            DB::table('osc_ind_lnomini')->insert(array_merge($nominee, [
                'nom_idpbt' => $this->pbtCode,
                'nom_idate' => Carbon::now()->subYear()->format('Y-m-d'),
                'nom_iuser' => 'SYSTEM',
            ]));
        }

        $this->command->info('Created 4 nominee records.');
    }

    private function createRenewals(array $licenseIds): void
    {
        $now = Carbon::now();

        $renewals = [
            // License 5 (KAFE SELERA TIMUR, 5 days to expiry) - initiated
            [
                'renewal_license_id' => $licenseIds[4],
                'renewal_application_id' => null,
                'renewal_type' => 'standard',
                'renewal_status' => 'initiated',
                'renewal_initiated_at' => $now->copy()->subDays(2),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R005',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'KAFE SELERA TIMUR',
                    'business_address' => ['line1' => 'NO 7, JALAN RAJA PERMAISURI BAINUN', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => 5,
                    'renewal_window' => true,
                    'no_violations' => true,
                    'no_arrears' => true,
                ]),
                'fast_track_eligible' => true,
                'grace_period_days' => 0,
                'penalty_amount' => 0.00,
                'renewal_fee' => 240.00,
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2),
            ],
            // License 4 (PASAR MINI SEJAHTERA, expired 10 days) - initiated with penalty
            [
                'renewal_license_id' => $licenseIds[3],
                'renewal_application_id' => null,
                'renewal_type' => 'standard',
                'renewal_status' => 'initiated',
                'renewal_initiated_at' => $now->copy()->subDays(3),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R004',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'PASAR MINI SEJAHTERA',
                    'business_address' => ['line1' => 'NO 99, JALAN GOPENG', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => -10,
                    'in_grace_period' => true,
                    'grace_period_remaining' => 20,
                    'no_violations' => true,
                    'no_arrears' => true,
                ]),
                'fast_track_eligible' => false,
                'grace_period_days' => 10,
                'penalty_amount' => 36.00,
                'renewal_fee' => 360.00,
                'renewal_notes' => 'Lesen tamat tempoh - dalam tempoh ihsan (penalti 10%)',
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(3),
            ],
            // License 7 (PUSAT TUISYEN CEMERLANG) - submitted, pending review
            [
                'renewal_license_id' => $licenseIds[6],
                'renewal_application_id' => null, // updated after creating application
                'renewal_type' => 'standard',
                'renewal_status' => 'submitted',
                'renewal_initiated_at' => $now->copy()->subDays(10),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R007',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'PUSAT TUISYEN CEMERLANG',
                    'business_address' => ['line1' => 'NO 55, JALAN TAMBUN', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => 30,
                    'renewal_window' => true,
                    'no_violations' => true,
                    'no_arrears' => true,
                ]),
                'fast_track_eligible' => false,
                'grace_period_days' => 0,
                'penalty_amount' => 0.00,
                'renewal_fee' => 120.00,
                'renewal_notes' => 'Pembaharuan lesen pusat tuisyen - menunggu semakan',
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(5),
            ],
            // License 8 (KEDAI ELEKTRIK JAYA) - completed fast-track renewal
            [
                'renewal_license_id' => $licenseIds[7],
                'renewal_application_id' => null, // updated after creating application
                'renewal_type' => 'fast_track',
                'renewal_status' => 'completed',
                'renewal_initiated_at' => $now->copy()->subMonths(7),
                'renewal_completed_at' => $now->copy()->subMonths(7)->addDays(15),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R008',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'KEDAI ELEKTRIK JAYA',
                    'business_address' => ['line1' => 'NO 101, JALAN PASIR PUTEH', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => 45,
                    'renewal_window' => true,
                    'no_violations' => true,
                    'no_arrears' => true,
                    'fast_track_criteria_met' => true,
                ]),
                'fast_track_eligible' => true,
                'grace_period_days' => 0,
                'penalty_amount' => 0.00,
                'renewal_fee' => 120.00,
                'renewal_notes' => 'Pembaharuan fast-track diluluskan secara automatik',
                'created_at' => $now->copy()->subMonths(7),
                'updated_at' => $now->copy()->subMonths(7)->addDays(15),
            ],
            // License 9 (KEDAI RUNCIT BARAKAH) - under_review
            [
                'renewal_license_id' => $licenseIds[8],
                'renewal_application_id' => null, // updated after creating application
                'renewal_type' => 'standard',
                'renewal_status' => 'under_review',
                'renewal_initiated_at' => $now->copy()->subDays(14),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R009',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'KEDAI RUNCIT BARAKAH',
                    'business_address' => ['line1' => 'NO 22, JALAN DATO ONN JAAFAR', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => 24,
                    'renewal_window' => true,
                    'no_violations' => true,
                    'no_arrears' => true,
                ]),
                'fast_track_eligible' => false,
                'grace_period_days' => 0,
                'penalty_amount' => 0.00,
                'renewal_fee' => 200.00,
                'renewal_notes' => 'Pembaharuan sedang disemak oleh pegawai',
                'created_at' => $now->copy()->subDays(14),
                'updated_at' => $now->copy()->subDays(7),
            ],
            // License 10 (SALON KECANTIKAN DIVA) - rejected
            [
                'renewal_license_id' => $licenseIds[9],
                'renewal_application_id' => null, // updated after creating application
                'renewal_type' => 'standard',
                'renewal_status' => 'rejected',
                'renewal_initiated_at' => $now->copy()->subDays(20),
                'renewal_completed_at' => $now->copy()->subDays(5),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R010',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'SALON KECANTIKAN DIVA',
                    'business_address' => ['line1' => 'NO 66, JALAN SULTAN AZLAN SHAH', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => true,
                    'days_until_expiry' => 15,
                    'renewal_window' => true,
                    'no_violations' => false,
                    'violations' => ['Aduan kesihatan awam - premis tidak bersih'],
                    'no_arrears' => true,
                ]),
                'fast_track_eligible' => false,
                'grace_period_days' => 0,
                'penalty_amount' => 0.00,
                'renewal_fee' => 180.00,
                'renewal_notes' => 'Ditolak - terdapat aduan kesihatan awam yang belum diselesaikan',
                'created_at' => $now->copy()->subDays(20),
                'updated_at' => $now->copy()->subDays(5),
            ],
            // License 11 (WARUNG MAKAN PAK ALI) - expired beyond grace period, not eligible
            [
                'renewal_license_id' => $licenseIds[10],
                'renewal_application_id' => null,
                'renewal_type' => 'standard',
                'renewal_status' => 'rejected',
                'renewal_initiated_at' => $now->copy()->subDays(10),
                'renewal_completed_at' => $now->copy()->subDays(9),
                'renewal_data' => json_encode([
                    'license_number' => 'LIC/2024/R011',
                    'customer_id' => $this->testCustomerId,
                    'pbt_code' => $this->pbtCode,
                    'business_name' => 'WARUNG MAKAN PAK ALI',
                    'business_address' => ['line1' => 'NO 3, JALAN KUALA KANGSAR', 'city' => 'IPOH'],
                ]),
                'eligibility_data' => json_encode([
                    'eligible' => false,
                    'days_until_expiry' => -45,
                    'in_grace_period' => false,
                    'grace_period_exceeded' => true,
                    'reason' => 'Lesen telah tamat melebihi tempoh ihsan 30 hari',
                ]),
                'fast_track_eligible' => false,
                'grace_period_days' => 45,
                'penalty_amount' => 0.00,
                'renewal_fee' => 0.00,
                'renewal_notes' => 'Ditolak automatik - lesen tamat melebihi tempoh ihsan (45 hari). Perlu mohon lesen baru.',
                'created_at' => $now->copy()->subDays(10),
                'updated_at' => $now->copy()->subDays(9),
            ],
        ];

        foreach ($renewals as $renewal) {
            DB::table('renewals')->insert($renewal);
        }

        $this->command->info('Created 7 renewal records.');
    }

    private function createRenewalApplications(array $licenseIds): array
    {
        $now = Carbon::now();

        // Application for submitted renewal (License 7 - PUSAT TUISYEN CEMERLANG)
        $submittedAppId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - PUSAT TUISYEN CEMERLANG',
            'mhn_emel' => 'test@example.com',
            'mhn_nomhp' => '0125557890',
            'mhn_kodlokasi' => 40,
            'mhn_namaperniagaan' => 'PUSAT TUISYEN CEMERLANG',
            'mhn_almtniaga1' => 'NO 55, JALAN TAMBUN',
            'mhn_almtniaga2' => 'IPOH',
            'mhn_poskod2' => '31400',
            'mhn_tkmohon' => $now->copy()->subDays(5)->format('Y-m-d'),
            'mhn_statl' => 'S',
            'mhn_tkmula' => $now->copy()->addDays(20)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->addDays(20)->addYear()->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->pbtCode . $now->copy()->subDays(5)->format('ym') . '0001',
            'mhn_norujukan' => 'REN/2026/001',
            'mhn_noakaun' => 90007,
            'mhn_idate' => $now->copy()->subDays(5)->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
        ]);

        DB::table('renewals')
            ->where('renewal_license_id', $licenseIds[6])
            ->where('renewal_status', 'submitted')
            ->update(['renewal_application_id' => $submittedAppId]);

        // Application for completed renewal (License 8 - KEDAI ELEKTRIK JAYA)
        $completedAppId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - KEDAI ELEKTRIK JAYA',
            'mhn_emel' => 'test@example.com',
            'mhn_nomhp' => '0125558901',
            'mhn_kodlokasi' => 23,
            'mhn_namaperniagaan' => 'KEDAI ELEKTRIK JAYA',
            'mhn_almtniaga1' => 'NO 101, JALAN PASIR PUTEH',
            'mhn_almtniaga2' => 'IPOH',
            'mhn_poskod2' => '31400',
            'mhn_tkmohon' => $now->copy()->subMonths(7)->format('Y-m-d'),
            'mhn_tarikhlulus' => $now->copy()->subMonths(7)->addDays(15)->format('Y-m-d'),
            'mhn_statl' => 'B',
            'mhn_tkmula' => $now->copy()->subMonths(6)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->addMonths(6)->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->pbtCode . $now->copy()->subMonths(7)->format('ym') . '0002',
            'mhn_norujukan' => 'REN/2025/012',
            'mhn_noakaun' => 90008,
            'mhn_idate' => $now->copy()->subMonths(7)->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
        ]);

        DB::table('renewals')
            ->where('renewal_license_id', $licenseIds[7])
            ->where('renewal_status', 'completed')
            ->update(['renewal_application_id' => $completedAppId]);

        // Application for under_review renewal (License 9 - KEDAI RUNCIT BARAKAH)
        $underReviewAppId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - KEDAI RUNCIT BARAKAH',
            'mhn_emel' => 'test@example.com',
            'mhn_nomhp' => '0125559012',
            'mhn_kodlokasi' => 23,
            'mhn_namaperniagaan' => 'KEDAI RUNCIT BARAKAH',
            'mhn_almtniaga1' => 'NO 22, JALAN DATO ONN JAAFAR',
            'mhn_almtniaga2' => 'IPOH',
            'mhn_poskod2' => '31400',
            'mhn_tkmohon' => $now->copy()->subDays(7)->format('Y-m-d'),
            'mhn_statl' => 'S',
            'mhn_tkmula' => $now->copy()->addDays(10)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->addDays(10)->addYear()->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->pbtCode . $now->copy()->subDays(7)->format('ym') . '0003',
            'mhn_norujukan' => 'REN/2026/002',
            'mhn_noakaun' => 90009,
            'mhn_idate' => $now->copy()->subDays(7)->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
        ]);

        DB::table('renewals')
            ->where('renewal_license_id', $licenseIds[8])
            ->where('renewal_status', 'under_review')
            ->update(['renewal_application_id' => $underReviewAppId]);

        // Application for rejected renewal (License 10 - SALON KECANTIKAN DIVA)
        $rejectedAppId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - SALON KECANTIKAN DIVA',
            'mhn_emel' => 'test@example.com',
            'mhn_nomhp' => '0125559123',
            'mhn_kodlokasi' => 35,
            'mhn_namaperniagaan' => 'SALON KECANTIKAN DIVA',
            'mhn_almtniaga1' => 'NO 66, JALAN SULTAN AZLAN SHAH',
            'mhn_almtniaga2' => 'IPOH',
            'mhn_poskod2' => '31400',
            'mhn_tkmohon' => $now->copy()->subDays(15)->format('Y-m-d'),
            'mhn_statl' => 'R',
            'mhn_tkmula' => $now->copy()->subDays(5)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->subDays(5)->addYear()->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->pbtCode . $now->copy()->subDays(15)->format('ym') . '0004',
            'mhn_norujukan' => 'REN/2026/003',
            'mhn_noakaun' => 90010,
            'mhn_idate' => $now->copy()->subDays(15)->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
        ]);

        DB::table('renewals')
            ->where('renewal_license_id', $licenseIds[9])
            ->where('renewal_status', 'rejected')
            ->update(['renewal_application_id' => $rejectedAppId]);

        // Application for approved (completed) renewal to test approved status separately
        // Using License 1 (RESTORAN NASI KANDAR PELITA) as an approved renewal from a previous cycle
        $approvedAppId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - RESTORAN NASI KANDAR PELITA',
            'mhn_emel' => 'test@example.com',
            'mhn_nomhp' => '0125551234',
            'mhn_kodlokasi' => 23,
            'mhn_namaperniagaan' => 'RESTORAN NASI KANDAR PELITA',
            'mhn_almtniaga1' => 'NO 12, JALAN SULTAN IDRIS SHAH',
            'mhn_almtniaga2' => 'IPOH',
            'mhn_poskod2' => '31400',
            'mhn_tkmohon' => $now->copy()->subYear()->format('Y-m-d'),
            'mhn_tarikhlulus' => $now->copy()->subYear()->addDays(10)->format('Y-m-d'),
            'mhn_statl' => 'B',
            'mhn_tkmula' => $now->copy()->subYear()->addDays(14)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->addDays(30)->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->pbtCode . $now->copy()->subYear()->format('ym') . '0005',
            'mhn_norujukan' => 'REN/2025/001',
            'mhn_noakaun' => 90001,
            'mhn_idate' => $now->copy()->subYear()->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
        ]);

        $this->command->info('Created 5 renewal application records.');

        return [
            'submitted' => $submittedAppId,
            'completed' => $completedAppId,
            'under_review' => $underReviewAppId,
            'rejected' => $rejectedAppId,
            'approved' => $approvedAppId,
        ];
    }

    private function createApplicationRelatedData(array $appIds): void
    {
        $now = Carbon::now();
        $nosiri1 = $this->pbtCode . $now->copy()->subDays(5)->format('ym') . '0001';
        $nosiri2 = $this->pbtCode . $now->copy()->subMonths(7)->format('ym') . '0002';
        $nosiri3 = $this->pbtCode . $now->copy()->subDays(7)->format('ym') . '0003';
        $nosiri4 = $this->pbtCode . $now->copy()->subDays(15)->format('ym') . '0004';

        // Transaction records for both apps
        DB::table('osc_mhn_transaksi')->insertOrIgnore([
            [
                'trn_idpbt' => $this->pbtCode,
                'trn_nosiri' => $nosiri1,
                'trn_akaun' => 90007,
                'trn_utama' => 1,
                'trn_kodjenis' => '01',
                'trn_kodsektor' => '001',
                'trn_kodaktiviti' => '01',
                'trn_idate' => $now->copy()->subDays(5)->format('Y-m-d'),
                'created_at' => now(),
            ],
            [
                'trn_idpbt' => $this->pbtCode,
                'trn_nosiri' => $nosiri2,
                'trn_akaun' => 90008,
                'trn_utama' => 1,
                'trn_kodjenis' => '02',
                'trn_kodsektor' => '002',
                'trn_kodaktiviti' => '01',
                'trn_idate' => $now->copy()->subMonths(7)->format('Y-m-d'),
                'created_at' => now(),
            ],
        ]);

        // Worker records - skip if table doesn't exist
        if (DB::getSchemaBuilder()->hasTable('osc_mhn_lpekerja')) {
            DB::table('osc_mhn_lpekerja')->insertOrIgnore([
                [
                    'lpk_idpbt' => $this->pbtCode,
                    'lpk_nosiri' => $nosiri1,
                    'lpk_melayu' => 3,
                    'lpk_cina' => 1,
                    'lpk_india' => 0,
                    'lpk_lainlain' => 0,
                    'lpk_idate' => $now->copy()->subDays(5)->format('Y-m-d'),
                    'lpk_iuser' => 'SYSTEM',
                    'created_at' => now(),
                ],
                [
                    'lpk_idpbt' => $this->pbtCode,
                    'lpk_nosiri' => $nosiri2,
                    'lpk_melayu' => 2,
                    'lpk_cina' => 0,
                    'lpk_india' => 1,
                    'lpk_lainlain' => 0,
                    'lpk_idate' => $now->copy()->subMonths(7)->format('Y-m-d'),
                    'lpk_iuser' => 'SYSTEM',
                    'created_at' => now(),
                ],
            ]);
        } else {
            $this->command->warn('Table osc_mhn_lpekerja does not exist, skipping application worker records.');
        }

        // Nominee record - skip if table doesn't exist
        if (DB::getSchemaBuilder()->hasTable('osc_mhn_lnomini')) {
            DB::table('osc_mhn_lnomini')->insertOrIgnore([
                'nom_idpbt' => $this->pbtCode,
                'nom_nosiri' => $nosiri1,
                'nom_idplgnom1' => '880202020002',
                'nom_namanom1' => 'SITI AMINAH BINTI AHMAD',
                'nom_trkhtmt1' => $now->copy()->addYear()->format('Y-m-d'),
                'nom_idate' => $now->copy()->subDays(5)->format('Y-m-d'),
                'nom_iuser' => 'SYSTEM',
                'created_at' => now(),
            ]);
        } else {
            $this->command->warn('Table osc_mhn_lnomini does not exist, skipping application nominee records.');
        }

        // Transaction and worker records for under_review app (KEDAI RUNCIT BARAKAH)
        DB::table('osc_mhn_transaksi')->insertOrIgnore([
            'trn_idpbt' => $this->pbtCode,
            'trn_nosiri' => $nosiri3,
            'trn_akaun' => 90009,
            'trn_utama' => 1,
            'trn_kodjenis' => '01',
            'trn_kodsektor' => '001',
            'trn_kodaktiviti' => '02',
            'trn_idate' => $now->copy()->subDays(7)->format('Y-m-d'),
            'created_at' => now(),
        ]);

        if (DB::getSchemaBuilder()->hasTable('osc_mhn_lpekerja')) {
            DB::table('osc_mhn_lpekerja')->insertOrIgnore([
                'lpk_idpbt' => $this->pbtCode,
                'lpk_nosiri' => $nosiri3,
                'lpk_melayu' => 3,
                'lpk_cina' => 2,
                'lpk_india' => 0,
                'lpk_lainlain' => 0,
                'lpk_idate' => $now->copy()->subDays(7)->format('Y-m-d'),
                'lpk_iuser' => 'SYSTEM',
                'created_at' => now(),
            ]);
        }

        // Transaction and worker records for rejected app (SALON KECANTIKAN DIVA)
        DB::table('osc_mhn_transaksi')->insertOrIgnore([
            'trn_idpbt' => $this->pbtCode,
            'trn_nosiri' => $nosiri4,
            'trn_akaun' => 90010,
            'trn_utama' => 1,
            'trn_kodjenis' => '02',
            'trn_kodsektor' => '003',
            'trn_kodaktiviti' => '01',
            'trn_idate' => $now->copy()->subDays(15)->format('Y-m-d'),
            'created_at' => now(),
        ]);

        if (DB::getSchemaBuilder()->hasTable('osc_mhn_lpekerja')) {
            DB::table('osc_mhn_lpekerja')->insertOrIgnore([
                'lpk_idpbt' => $this->pbtCode,
                'lpk_nosiri' => $nosiri4,
                'lpk_melayu' => 2,
                'lpk_cina' => 0,
                'lpk_india' => 0,
                'lpk_lainlain' => 1,
                'lpk_idate' => $now->copy()->subDays(15)->format('Y-m-d'),
                'lpk_iuser' => 'SYSTEM',
                'created_at' => now(),
            ]);
        }

        $this->command->info('Created application-related records (transactions, workers, nominees).');
    }

    private function createBillingRecords(array $appIds): void
    {
        // Skip if osc_bil_invois table doesn't exist
        if (!DB::getSchemaBuilder()->hasTable('osc_bil_invois')) {
            $this->command->warn('Table osc_bil_invois does not exist, skipping billing records.');
            return;
        }

        $now = Carbon::now();
        $year = $now->format('Y');

        $bills = [
            // Bill for submitted renewal (PUSAT TUISYEN CEMERLANG) - Unpaid
            [
                'inv_nobil' => 'BIL/' . $this->pbtCode . '/' . $year . '/' . str_pad($appIds['submitted'], 8, '0', STR_PAD_LEFT),
                'inv_idpbt' => $this->pbtCode,
                'inv_idpermohonan' => $appIds['submitted'],
                'inv_idpelanggan' => $this->testCustomerId,
                'inv_jumlah' => 120.00,
                'inv_status' => 'U', // Unpaid
                'inv_jenis' => 'P', // Pembaharuan
                'inv_tkhjana' => $now->copy()->subDays(5),
                'inv_idate' => $now->copy()->subDays(5),
                'inv_iuser' => 'SYSTEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Bill for under_review renewal (KEDAI RUNCIT BARAKAH) - Unpaid
            [
                'inv_nobil' => 'BIL/' . $this->pbtCode . '/' . $year . '/' . str_pad($appIds['under_review'], 8, '0', STR_PAD_LEFT),
                'inv_idpbt' => $this->pbtCode,
                'inv_idpermohonan' => $appIds['under_review'],
                'inv_idpelanggan' => $this->testCustomerId,
                'inv_jumlah' => 200.00,
                'inv_status' => 'U', // Unpaid
                'inv_jenis' => 'P', // Pembaharuan
                'inv_tkhjana' => $now->copy()->subDays(7),
                'inv_idate' => $now->copy()->subDays(7),
                'inv_iuser' => 'SYSTEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Bill for completed renewal (KEDAI ELEKTRIK JAYA) - Paid
            [
                'inv_nobil' => 'BIL/' . $this->pbtCode . '/' . $year . '/' . str_pad($appIds['completed'], 8, '0', STR_PAD_LEFT),
                'inv_idpbt' => $this->pbtCode,
                'inv_idpermohonan' => $appIds['completed'],
                'inv_idpelanggan' => $this->testCustomerId,
                'inv_jumlah' => 120.00,
                'inv_status' => 'B', // Bayar (Paid)
                'inv_jenis' => 'P', // Pembaharuan
                'inv_tkhjana' => $now->copy()->subMonths(7),
                'inv_idate' => $now->copy()->subMonths(7),
                'inv_iuser' => 'SYSTEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Bill for rejected renewal (SALON KECANTIKAN DIVA) - Cancelled
            [
                'inv_nobil' => 'BIL/' . $this->pbtCode . '/' . $year . '/' . str_pad($appIds['rejected'], 8, '0', STR_PAD_LEFT),
                'inv_idpbt' => $this->pbtCode,
                'inv_idpermohonan' => $appIds['rejected'],
                'inv_idpelanggan' => $this->testCustomerId,
                'inv_jumlah' => 180.00,
                'inv_status' => 'X', // Cancelled
                'inv_jenis' => 'P', // Pembaharuan
                'inv_tkhjana' => $now->copy()->subDays(15),
                'inv_idate' => $now->copy()->subDays(15),
                'inv_iuser' => 'SYSTEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($bills as $bill) {
            DB::table('osc_bil_invois')->insert($bill);
        }

        $this->command->info('Created 4 billing records.');
    }
}
