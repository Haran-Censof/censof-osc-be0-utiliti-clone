<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * SL_MBSA Transaction Seeder
 *
 * Creates demo transaction data for testing with trn_akaun = 10001 and trn_idpbt = 'SL_MBSA'
 * This is specifically for testing the transaction cancellation screen with SL_MBSA PBT.
 *
 * Run: php artisan db:seed --class=SLMBSATransactionSeeder
 *
 * Data created:
 * - 1 customer record (osc_da_pelanggan) for SL_MBSA
 * - 1 license record (osc_ind_induklesen)
 * - 1 business code record (osc_ind_translesen)
 * - 1 application record (osc_mhn_permohonan)
 * - 1 transaction record (osc_mhn_transaksi) with trn_kodniaga
 */
class SLMBSATransactionSeeder extends Seeder
{
    private string $testCustomerId = '900101012345';
    private string $pbtCode = 'SL_MBSA';
    private int $accountNumber = 10001;

    public function run(): void
    {
        $this->command->info('Seeding SL_MBSA transaction demo data...');

        $this->createCustomer();
        $this->createLicense();
        $this->createBusinessCode();
        $applicationId = $this->createApplication();
        $this->createTransaction($applicationId);

        $this->command->info('SL_MBSA transaction demo data seeded successfully.');
    }

    private function createCustomer(): void
    {
        DB::table('osc_da_pelanggan')->updateOrInsert(
            ['pp_plg_pelangganid' => $this->testCustomerId],
            [
                'pp_plg_pelanggannama' => 'SITI NURHALIZA BINTI AHMAD',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => $this->testCustomerId,
                'pp_plg_notel' => '0191234567',
                'pp_plg_emel' => 'siti@example.com',
                'created_at' => Carbon::now()->subYear(),
                'updated_at' => Carbon::now(),
            ]
        );

        $this->command->info('Created customer record for SL_MBSA.');
    }

    private function createLicense(): void
    {
        $now = Carbon::now();

        DB::table('osc_ind_induklesen')->updateOrInsert(
            ['ind_noakaun' => $this->accountNumber],
            [
                'ind_idpbt' => $this->pbtCode,
                'ind_idpelanggan' => $this->testCustomerId,
                'ind_nosiri' => $this->accountNumber,
                'ind_namaperniagaan' => 'KEDAI RUNCIT MAJU JAYA',
                'ind_almtperniagaan' => 'NO 88, JALAN PERBANDARAN, SHAH ALAM',
                'ind_norujukan' => 'LIC/2025/SL001',
                'ind_kodlokasi' => 1,
                'ind_katniaga' => 1,
                'ind_jenisplg' => 'I',
                'ind_tkmohon' => $now->copy()->subMonths(6)->format('Y-m-d'),
                'ind_tarikhlulus' => $now->copy()->subMonths(6)->addDays(14)->format('Y-m-d'),
                'ind_statl' => 'B',
                'ind_tkmula' => $now->copy()->subMonths(5)->format('Y-m-d'),
                'ind_tktamat' => $now->copy()->addMonths(7)->format('Y-m-d'),
                'ind_tempoh' => 12,
                'ind_tkhmsyuarat' => $now->copy()->subMonths(6)->format('Y-m-d'),
                'ind_notelefon' => '0191234567',
                'ind_idate' => $now->copy()->subMonths(6)->format('Y-m-d'),
                'ind_iuser' => 'SYSTEM',
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now(),
            ]
        );

        $this->command->info('Created license record for account ' . $this->accountNumber);
    }

    private function createBusinessCode(): void
    {
        DB::table('osc_ind_translesen')->updateOrInsert(
            ['trn_akaun' => $this->accountNumber],
            [
                'trn_idpbt' => $this->pbtCode,
                'trn_akaun' => $this->accountNumber,
                'trn_kodniaga1' => '01',
                'trn_kodniaga2' => '001',
                'trn_kodniaga3' => '01',
                'trn_sequtama' => 1,
                'trn_stattrans' => 'A',
                'trn_idate' => Carbon::now()->subMonths(6)->format('Y-m-d'),
                'trn_iuser' => 'SYSTEM',
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now(),
            ]
        );

        $this->command->info('Created business code record.');
    }

    private function createApplication(): int
    {
        $now = Carbon::now();

        $applicationId = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'P',
            'mhn_jenis' => '1',
            'mhn_idpelanggan' => $this->testCustomerId,
            'mhn_nama' => 'PEMBAHARUAN - KEDAI RUNCIT MAJU JAYA',
            'mhn_emel' => 'siti@example.com',
            'mhn_nomhp' => '0191234567',
            'mhn_kodlokasi' => 1,
            'mhn_namaperniagaan' => 'KEDAI RUNCIT MAJU JAYA',
            'mhn_almtniaga1' => 'NO 88, JALAN PERBANDARAN',
            'mhn_almtniaga2' => 'SHAH ALAM',
            'mhn_poskod2' => '40000',
            'mhn_tkmohon' => $now->copy()->subMonths(5)->format('Y-m-d'),
            'mhn_tarikhlulus' => $now->copy()->subMonths(5)->addDays(14)->format('Y-m-d'),
            'mhn_statl' => 'B',
            'mhn_statbatal' => 'T', // Not cancelled
            'mhn_tkmula' => $now->copy()->subMonths(4)->format('Y-m-d'),
            'mhn_tktamat' => $now->copy()->addMonths(8)->format('Y-m-d'),
            'mhn_tempoh' => 12,
            'mhn_jenisplg' => 'I',
            'mhn_nosiri' => $this->accountNumber,
            'mhn_norujukan' => 'APP/2025/SL001',
            'mhn_noakaun' => $this->accountNumber,
            'mhn_kodsektor' => '01',
            'mhn_kodaktiviti' => '001',
            'mhn_idate' => $now->copy()->subMonths(5)->format('Y-m-d'),
            'mhn_iuser' => $this->testCustomerId,
            'mhn_udate' => $now->format('Y-m-d'),
            'mhn_uuser' => 'SYSTEM',
            'created_at' => Carbon::now()->subMonths(5),
            'updated_at' => Carbon::now(),
        ]);

        $this->command->info('Created application record with ID: ' . $applicationId);

        return $applicationId;
    }

    private function createTransaction(int $applicationId): void
    {
        $now = Carbon::now();

        DB::table('osc_mhn_transaksi')->updateOrInsert(
            [
                'trn_nosiri' => $this->accountNumber,
                'trn_akaun' => $this->accountNumber,
            ],
            [
                'trn_idpbt' => $this->pbtCode,
                'trn_nosiri' => $applicationId,
                'trn_akaun' => $this->accountNumber,
                'trn_utama' => 1,
                'trn_kodniaga' => '0100101', // Main field for kod niaga
                'trn_kodp1' => '01',       // Sektor
                'trn_kodp2' => '001',      // Aktiviti
                'trn_kodp3' => '01',       // Niaga
                'trn_tmbhkurng' => 0,
                'trn_scagr' => 'T',        // No cagaran required
                'trn_ckaun' => null,
                'trn_statt' => 'A',        // Active
                'trn_idate' => $now->copy()->subMonths(4)->format('Y-m-d'),
                'trn_iuser' => 'SYSTEM',
                'trn_udate' => $now->format('Y-m-d'),
                'trn_uuser' => 'SYSTEM',
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now(),
            ]
        );

        $this->command->info('Created transaction record for trn_akaun=' . $this->accountNumber . ', trn_idpbt=' . $this->pbtCode);
    }
}