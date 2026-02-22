<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RealisticApplicationSeeder extends Seeder
{
    /**
     * Run the database seeder to create 15 realistic Malaysian license applications.
     */
    public function run(): void
    {
        $this->command->info('Creating 15 realistic Malaysian license applications...');

        $baseSerialNumber = 90000;
        $baseAccountId = 100000;
        $pbtCode = "PRK_MDTM";

        // Combined Data Source (Individuals & Companies)
        $applications = [
            // Individual Applications
            [
                'type' => 'individual',
                'name' => 'Ahmad bin Abdullah',
                'id_number' => '850101015555',
                'business_name' => 'Kedai Gunting Rambut Ahmad',
                'category' => 'Premis Perniagaan',
                'address1' => 'No. 45, Jalan Merdeka',
                'address2' => 'Taman Melati',
                'city' => 'Kuala Lumpur',
                'postcode' => '53100',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'ahmad.abdullah@gmail.com',
                'mobile' => '019-3456789',
                'license_type_id' => 1,
                'sektor_code' => '01', // Perkhidmatan
                'aktiviti_code' => '01', // Gunting Rambut
                'niaga_id' => 101,
                'status' => 'B', // Baru
                'workers' => ['malay' => 2, 'chinese' => 0, 'indian' => 0, 'other' => 0],
                'ads' => [
                    ['type' => 'Papan Tanda', 'len' => 4, 'width' => 2, 'loc' => 'Premis', 'desc' => 'Papan Tanda Kedai', 'amt' => 100]
                ]
            ],
            [
                'type' => 'individual',
                'name' => 'Siti Nurhaliza binti Mohamed',
                'id_number' => '900202086666',
                'business_name' => 'Restoran Siti Sedap',
                'category' => 'Premis Makanan',
                'address1' => 'Lot 12, Jalan Raja',
                'address2' => 'Kampung Baru',
                'city' => 'Ipoh',
                'postcode' => '30010',
                'state' => 'Perak',
                'email' => 'siti.nurhaliza@yahoo.com',
                'mobile' => '012-7654321',
                'license_type_id' => 1,
                'sektor_code' => '02', // Makanan
                'aktiviti_code' => '01', // Restoran
                'niaga_id' => 201,
                'status' => 'B', // Semakan
                'workers' => ['malay' => 5, 'chinese' => 0, 'indian' => 1, 'other' => 2],
                'ads' => [
                    ['type' => 'Papan Tanda', 'len' => 6, 'width' => 3, 'loc' => 'Hadapan', 'desc' => 'Restoran Siti Sedap', 'amt' => 200]
                ]
            ],
            [
                'type' => 'individual',
                'name' => 'Lee Wei Ming',
                'id_number' => '880303107777',
                'business_name' => 'Wei Ming Electrical Shop',
                'category' => 'Premis Perniagaan',
                'address1' => '88, Jalan Pudu',
                'address2' => 'Pudu Plaza',
                'city' => 'Kuala Lumpur',
                'postcode' => '55100',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'weiming88@hotmail.com',
                'mobile' => '016-8901234',
                'license_type_id' => 1,
                'sektor_code' => '03', // Peruncitan
                'aktiviti_code' => '01', // Barangan Elektrik
                'niaga_id' => 301,
                'status' => 'B', // Lulus
                'workers' => ['malay' => 1, 'chinese' => 3, 'indian' => 0, 'other' => 0],
                'ads' => [
                    ['type' => 'Light Box', 'len' => 3, 'width' => 4, 'loc' => 'Dinding', 'desc' => 'Simpang Masuk', 'amt' => 150]
                ]
            ],
            [
                'type' => 'individual',
                'name' => 'Fatimah binti Hassan',
                'id_number' => '920404148888',
                'business_name' => 'Klinik Fatimah',
                'category' => 'Premis Kesihatan',
                'address1' => 'No. 156, Jalan Dato Onn',
                'address2' => 'Taman Tun Dr Ismail',
                'city' => 'Kuala Lumpur',
                'postcode' => '60000',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'klinik.fatimah@gmail.com',
                'mobile' => '013-4567890',
                'license_type_id' => 2,
                'sektor_code' => '04', // Kesihatan
                'aktiviti_code' => '01', // Klinik
                'niaga_id' => 401,
                'status' => 'B',
                'workers' => ['malay' => 4, 'chinese' => 1, 'indian' => 1, 'other' => 0],
                'ads' => [
                    ['type' => 'Light Box', 'len' => 3, 'width' => 4, 'loc' => 'Dinding', 'desc' => 'Simpang Masuk', 'amt' => 150]
                ]
            ],
            [
                'type' => 'individual',
                'name' => 'Raj Kumar a/l Ramesh',
                'id_number' => '801212029999',
                'business_name' => 'Bengkel Raj Motor',
                'category' => 'Bengkel',
                'address1' => 'No. 23, Jalan Ipoh',
                'address2' => 'Batu Caves',
                'city' => 'Selayang',
                'postcode' => '68100',
                'state' => 'Selangor',
                'email' => 'rajmotor@gmail.com',
                'mobile' => '017-2345678',
                'license_type_id' => 1,
                'sektor_code' => '05', // Automotif
                'aktiviti_code' => '01', // Bengkel
                'niaga_id' => 501,
                'status' => 'B', // Tolak
                'workers' => ['malay' => 2, 'chinese' => 0, 'indian' => 3, 'other' => 0],
                'ads' => [
                    ['type' => 'Light Box', 'len' => 3, 'width' => 4, 'loc' => 'Dinding', 'desc' => 'Simpang Masuk', 'amt' => 150]
                ]
            ],
            // Company Applications
            [
                'type' => 'company',
                'name' => 'Restoran Nasi Kandar Pelita Sdn Bhd',
                'auth_name' => 'Kamal bin Abdullah',
                'id_number' => '750505011111',
                'business_name' => 'Restoran Nasi Kandar Pelita Sdn Bhd',
                'category' => 'Premis Makanan',
                'address1' => 'No. 178, Jalan Ampang',
                'address2' => null,
                'city' => 'Kuala Lumpur',
                'postcode' => '50450',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'pelita.kl@gmail.com',
                'mobile' => '012-3334444',
                'license_type_id' => 1,
                'sektor_code' => '02',
                'aktiviti_code' => '02', // Nasi Kandar
                'niaga_id' => 202,
                'status' => 'B', // Lulus
                'workers' => ['malay' => 10, 'chinese' => 2, 'indian' => 15, 'other' => 8],
                'ads' => [
                    ['type' => 'Papan Tanda', 'len' => 10, 'width' => 4, 'loc' => 'Bumbung', 'desc' => 'Papan Tanda Besar', 'amt' => 500]
                ]
            ],
            [
                'type' => 'company',
                'name' => 'Farmasi Medik Care Sdn Bhd',
                'auth_name' => 'Dr. Lim Siew Mei',
                'id_number' => '820606072222',
                'business_name' => 'Farmasi Medik Care Sdn Bhd',
                'category' => 'Premis Kesihatan',
                'address1' => 'No. 88, Jalan SS2/72',
                'address2' => null,
                'city' => 'Petaling Jaya',
                'postcode' => '47300',
                'state' => 'Selangor',
                'email' => 'medikcare@outlook.com',
                'mobile' => '016-5556666',
                'license_type_id' => 1,
                'sektor_code' => '04',
                'aktiviti_code' => '02', // Farmasi
                'niaga_id' => 402,
                'status' => 'B',
                'workers' => ['malay' => 3, 'chinese' => 4, 'indian' => 1, 'other' => 0],
                'ads' => [
                    ['type' => 'Light Box', 'len' => 3, 'width' => 4, 'loc' => 'Dinding', 'desc' => 'Simpang Masuk', 'amt' => 150]
                ]
            ],
            [
                'type' => 'company',
                'name' => 'Butik Fesyen Elegan Enterprise',
                'auth_name' => 'Aishah binti Mahmud',
                'id_number' => '950707143333',
                'business_name' => 'Butik Fesyen Elegan',
                'category' => 'Premis Perniagaan',
                'address1' => 'Lot 45, Jalan Tuanku Abdul Rahman',
                'address2' => null,
                'city' => 'Kuala Lumpur',
                'postcode' => '50100',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'elegan.butik@gmail.com',
                'mobile' => '013-7778888',
                'license_type_id' => 1,
                'sektor_code' => '03', // Peruncitan
                'aktiviti_code' => '03', // Pakaian
                'niaga_id' => 303,
                'status' => 'B',
                'workers' => ['malay' => 5, 'chinese' => 0, 'indian' => 0, 'other' => 0],
                'ads' => [
                    ['type' => 'Banner', 'len' => 3, 'width' => 6, 'loc' => 'Tiang Lampu', 'desc' => 'Promosi Raya', 'amt' => 50]
                ]
            ],
             [
                'type' => 'company',
                'name' => 'Klinik Kesihatan Prima Sdn Bhd',
                'auth_name' => 'Dr. Kumar a/l Subramaniam',
                'id_number' => '780808054444',
                'business_name' => 'Klinik Kesihatan Prima',
                'category' => 'Premis Kesihatan',
                'address1' => 'No. 12, Jalan PJU 5/9',
                'address2' => 'Kota Damansara',
                'city' => 'Petaling Jaya',
                'postcode' => '47810',
                'state' => 'Selangor',
                'email' => 'klinik.prima@gmail.com',
                'mobile' => '019-9990000',
                'license_type_id' => 1,
                'sektor_code' => '04',
                'aktiviti_code' => '01', // Klinik
                'niaga_id' => 401,
                'status' => 'B',
                'workers' => ['malay' => 8, 'chinese' => 2, 'indian' => 5, 'other' => 0],
                'ads' => [
                    ['type' => 'Light Box', 'len' => 3, 'width' => 4, 'loc' => 'Dinding', 'desc' => 'Simpang Masuk', 'amt' => 150]
                ]
            ],
            [
                'type' => 'company',
                'name' => 'Bengkel Kereta Jaya Motor Sdn Bhd',
                'auth_name' => 'Hassan bin Omar',
                'id_number' => '830909015555',
                'business_name' => 'Bengkel Kereta Jaya Motor',
                'category' => 'Bengkel',
                'address1' => 'No. 234, Jalan Gombak',
                'address2' => null,
                'city' => 'Kuala Lumpur',
                'postcode' => '53000',
                'state' => 'Wilayah Persekutuan Kuala Lumpur',
                'email' => 'jayamotor@yahoo.com',
                'mobile' => '017-1112222',
                'license_type_id' => 1,
                'sektor_code' => '05',
                'aktiviti_code' => '01', // Bengkel
                'niaga_id' => 501,
                'status' => 'B',
                'workers' => ['malay' => 12, 'chinese' => 2, 'indian' => 4, 'other' => 5],
                'ads' => [
                     ['type' => 'Papan Tanda', 'len' => 5, 'width' => 2, 'loc' => 'Premis', 'desc' => 'Nama Bengkel', 'amt' => 100]
                ]
            ],
        ];
        
        // TRUNCATE TABLES (Per User Request)
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->command->info('Truncating related tables...');
        DB::table('osc_mhn_iklan')->truncate();
        DB::table('osc_mhn_lpekerja')->truncate();
        DB::table('osc_mhn_transaksi')->truncate();
        DB::table('osc_mhn_dokumen')->truncate();
        DB::table('osc_mhn_permohonan')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Generate 20 applications: 10 New (Baru), 10 Renewal (Pembaharuan)
        $totalApps = 20;

        // Fetch all available KodNiaga to ensure unique assignment (avoiding the global unique index issue)
        $availableNiaga = DB::table('osc_kod_niaga')
            ->where('nia_idpbt', $pbtCode)
            ->get();
            
        if ($availableNiaga->count() < $totalApps) {
            $this->command->warn("Warning: Only found {$availableNiaga->count()} unique business codes. Some applications might not be seeded or will lack transactions if unique constraint 'mhn_transaksi_uk' exists.");
        }
        
        // Shuffle to randomize assignment
        $shuffledNiaga = $availableNiaga->shuffle();

        for ($i = 0; $i < $totalApps; $i++) {
            // Cycle through the base application templates
            $templateIndex = $i % count($applications);
            $app = $applications[$templateIndex];
            
                // Assign a unique Niaga record if available
            $niagaRecord = $shuffledNiaga->pop(); 

            // If we ran out of unique Niaga records, we might hit the duplicate error.
            // We'll try to use the template's default if we have to, but warn.
            if (!$niagaRecord) {
                 // Try to fallback to template's data, but this will likely crash if schema isn't fixed
                 $niagaRecord = (object)[
                    'nia_kodniaga3' => '01',
                    'nia_statcgrn' => 'T',
                    'nia_gldebit' => null,
                    'nia_kodaktiviti' => $app['aktiviti_code'],
                    'nia_kodniaga1' => $app['sektor_code'],
                    // nia_kodniaga2 is assumed to be aktiviti matches
                 ];
            } else {
                // If we found a unique record, OVERRIDE the template's sector/activity to match this unique code
                // This ensures we respect the unique key (idpbt, kodp1, kodp2, kodp3) - though new schema ignores this?
                // Migration 2026_01_27 in be0-utilities creates osc_kod_niaga with nia_kodniaga.
                
                // Use safe access 
                // Note: migration says 'nia_kodniaga' is 12 chars: UNDANG||AKT||RUN
                // It does NOT have 'nia_kodniaga1' etc.
                
                $app['sektor_code'] = isset($niagaRecord->nia_kodundang) ? $niagaRecord->nia_kodundang : '01'; // Fallback
                $app['aktiviti_code'] = isset($niagaRecord->nia_kodaktiviti) ? $niagaRecord->nia_kodaktiviti : '001';
                
                $app['niaga_id'] = $niagaRecord->id ?? 0;
                
                // Also update description to match the assigned business code so it looks realistic
                $app['business_name'] = ucwords(strtolower($niagaRecord->nia_keterangan ?? "Perniagaan " . ($niagaRecord->id ?? rand(999,9999))));
            }

            // Determine if New or Renewal
            // First 10 (0-9) are New, Next 10 (10-19) are Renewal
            $isRenewal = $i >= 10;
            $mhnJenisMhn = $isRenewal ? 'R' : 'B';
            
            // Unique Index for this iteration
            $index = $i; 

            $serialNumber = $baseSerialNumber + $index + 1;
            $runningNumber = str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            $yearMonth = Carbon::now()->format('ym');
            $mhnNosiri = $pbtCode . $yearMonth . $runningNumber;
            $customerId = "CUST-" . str_pad($serialNumber, 8, '0', STR_PAD_LEFT);

            $status = $app['status']; 
            if ($isRenewal) {
                // Keep simpler status for renewal
            }

            // 1. Create/Update Customer Profile
            
            // 2. Cleanup Existing Data - REMOVED (Truncated at start)
            // DB::table('osc_mhn_iklan')->where('lan_nosiri', $mhnNosiri)->delete();
            // DB::table('osc_mhn_lpekerja')->where('lpk_nosiri', $mhnNosiri)->delete();
            // DB::table('osc_mhn_transaksi')->where('trn_nosiri', $mhnNosiri)->delete();
            // DB::table('osc_mhn_permohonan')->where('mhn_nosiri', $mhnNosiri)->delete();
            
            // cleanup docs by ID if possible, else skip (auto-inc IDs handled by DB)
            // $existingAppId = DB::table('osc_mhn_permohonan')->where('mhn_nosiri', $mhnNosiri)->value('id');
            // if($existingAppId) {
            //     DB::table('osc_mhn_dokumen')->where('doc_nosiri', $existingAppId)->delete();
            // }

            // 3. Insert Application (osc_mhn_permohonan)
            $appData = [
                "mhn_idpbt" => $pbtCode,
                "mhn_jenismhn" => $mhnJenisMhn,
                "mhn_jenis" => ($app['type'] === 'company') ? "1" : "1",
                "mhn_idpelanggan" => $customerId,
                "mhn_nama" => $app['type'] === 'company' ? $app['auth_name'] : $app['name'],
                "mhn_alamatpos1" => $app['address1'],
                "mhn_alamatpos2" => $app['address2'],
                "mhn_alamatpos3" => $app['postcode'] . ' ' . $app['city'],
                "mhn_alamatpos4" => $app['state'],
                "mhn_poskod" => $app['postcode'],
                "mhn_emel" => $app['email'],
                "mhn_nomhp" => $app['mobile'],
                "mhn_kodlokasi" => rand(1, 50),
                "mhn_kodsektor" => $app['sektor_code'],
                "mhn_kodaktiviti" => $app['aktiviti_code'],
                "mhn_idniaga" => $app['niaga_id'],
                "mhn_namaperniagaan" => $app['business_name'] . ($isRenewal ? " (Renewal)" : ""),
                "mhn_almtniaga1" => $app['address1'],
                "mhn_almtniaga2" => $app['address2'],
                "mhn_almtniaga3" => $app['postcode'] . ' ' . $app['city'],
                "mhn_almtniaga4" => $app['state'],
                "mhn_poskod2" => $app['postcode'],
                "mhn_tkmohon" => Carbon::now()->subDays(rand(1, 60))->format('Y-m-d H:i:s'),
                "mhn_statl" => $status,
                "mhn_tkmula" => ($status === 'L') ? Carbon::now()->format('Y-m-d H:i:s') : null,
                "mhn_tktamat" => ($status === 'L') ? Carbon::now()->addYear()->format('Y-m-d H:i:s') : null,
                "mhn_tempoh" => 12,
                "mhn_msmula" => "09:00",
                "mhn_mstamat" => "18:00",
                "mhn_jenisplg" => ($app['type'] === 'company') ? "S" : "I",
                "mhn_nosiri" => $mhnNosiri,
                "mhn_norujukan" => "APP/" . Carbon::now()->year . "/" . $runningNumber,
                "mhn_noakaun" => $baseAccountId + $index,
                "mhn_idate" => Carbon::now()->subDays(rand(1, 60))->format('Y-m-d H:i:s'),
                "mhn_iuser" => "SEEDER",
                "mhn_kodssm" => ($app['type'] === 'company') ? "SSM-REG-" . rand(100000, 999999) : null,
            ];

            $appId = DB::table('osc_mhn_permohonan')->insertGetId($appData);

            // 3. Insert Worker Statistics
            if (isset($app['workers'])) {
                DB::table('osc_mhn_lpekerja')->insert([
                    'lpk_idpbt' => $pbtCode,
                    'lpk_nosiri' => $serialNumber,
                    'lpk_melayu' => $app['workers']['malay'],
                    'lpk_cina' => $app['workers']['chinese'],
                    'lpk_india' => $app['workers']['indian'],
                    'lpk_lainlain' => $app['workers']['other'],
                    'lpk_idate' => Carbon::now()->format('Y-m-d H:i:s'),
                    'lpk_iuser' => "SEEDER",
                ]);
            }

            // 4. Insert Advertisements
            if (!empty($app['ads'])) {
                foreach ($app['ads'] as $ad) {
                    DB::table('osc_mhn_iklan')->insert([
                        'lan_idpbt' => $pbtCode,
                        'lan_nosiri' => $serialNumber,
                        'lan_stajn' => substr($ad['type'], 0, 1), 
                        'lan_panjg' => $ad['len'],
                        'lan_lebar' => $ad['width'],
                        'lan_tempt' => $ad['loc'],
                        'lan_keter' => $ad['desc'],
                        'lan_amaun' => $ad['amt'],
                        'lan_idate' => Carbon::now()->format('Y-m-d H:i:s'),
                        'lan_iuser' => "SEEDER",
                    ]);
                }
            }

            // 5. Insert Transaction
            // Updated per user request: Seed trn_kodniaga, trn_risiko instead of trn_kodp1-3
            
            // Fixed: use `nia_kodniaga` from osc_kod_niaga table (confirmed locally in be0-utilities migration)
            $trnKodNiaga = isset($niagaRecord->nia_kodniaga) ? $niagaRecord->nia_kodniaga : null;
            $trnRisiko = isset($niagaRecord->nia_risiko) ? $niagaRecord->nia_risiko : 'Rendah';
            $trnScagr = isset($niagaRecord->nia_statcgrn) ? $niagaRecord->nia_statcgrn : 'T';
            $trnCkaun = isset($niagaRecord->nia_gldebit) ? $niagaRecord->nia_gldebit : null; 

            try {
                DB::table('osc_mhn_transaksi')->insert([
                    'trn_idpbt' => $pbtCode,
                    'trn_nosiri' => $mhnNosiri,
                    'trn_akaun' => $baseAccountId + $index,
                    'trn_utama' => 1, 
                    // 'trn_kodp1' => ... REMOVED
                    // 'trn_kodp2' => ... REMOVED
                    // 'trn_kodp3' => ... REMOVED
                    'trn_kodniaga' => $trnKodNiaga, 
                    'trn_risiko' => $trnRisiko,     
                    'trn_scagr' => $trnScagr,
                    'trn_ckaun' => $trnCkaun,
                    'trn_idate' => Carbon::now()->format('Y-m-d H:i:s'),
                    'trn_iuser' => "SEEDER",
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                // If duplicate entry logic persists (e.g. not enough unique codes), catch and warn
                if ($e->getCode() == '23000') {
                    $this->command->error("Skipped Transaction for {$mhnNosiri} due to unique constraint.");
                } else {
                    throw $e;
                }
            }

            // 6. Insert Documents
            // Create dummy files if missing
            if (!Storage::disk('public')->exists('documents/dummy.pdf')) {
                Storage::disk('public')->put('documents/dummy.pdf', '%PDF-1.4...Dummy PDF Content...');
            }
             if (!Storage::disk('public')->exists('documents/dummy.jpg')) {
                Storage::disk('public')->put('documents/dummy.jpg', 'Dummy Image Content');
            }

            // Get required document types
            $requiredDocCodes = ['02', '03', '04', '05', '06', '07', '08', '09'];
            
            $docTypes = DB::table('osc_kod_dokumen')
                ->where('doc_idpbt', $pbtCode)
                ->whereIn('doc_kddocmt', $requiredDocCodes)
                ->where('doc_jenismhn', 'B') 
                ->orderBy('doc_kddocmt')
                ->get();

            if ($docTypes->isEmpty()) {
                $docTypes = DB::table('osc_kod_dokumen')
                    ->whereIn('doc_kddocmt', $requiredDocCodes)
                    ->where('doc_jenismhn', 'B')
                    ->groupBy('doc_kddocmt') 
                    ->orderBy('doc_kddocmt')
                    ->get();
            }

            foreach ($docTypes as $docType) {
                $isImage = str_contains(strtolower($docType->doc_docdesc), 'gambar') || str_contains(strtolower($docType->doc_docdesc), 'photo');
                
                $path = $isImage ? 'documents/dummy.jpg' : 'documents/dummy.pdf';
                $mime = $isImage ? 'image/jpeg' : 'application/pdf';
                $filename = str_replace(' ', '_', strtolower($docType->doc_docdesc)) . ($isImage ? '.jpg' : '.pdf');

                DB::table('osc_mhn_dokumen')->insert([
                    'doc_idpbt' => $pbtCode,
                    'doc_nosiri' => $appId,
                    'doc_akaun' => $baseAccountId + $index,
                    'doc_dcsiri' => $docType->id, 
                    'doc_dokumen' => $path,
                    'doc_catatan' => $docType->doc_docdesc . ': ' . $filename,
                    'original_filename' => $filename,
                    'mime_type' => $mime,
                    'doc_idate' => Carbon::now()->format('Y-m-d H:i:s'),
                    'doc_iuser' => "SEEDER",
                    'current_version' => 1,
                    'is_mandatory' => $docType->doc_statusd === 'M' ? 1 : 0,
                    'page_count' => 1,
                ]);
            }

            $this->command->info("Seeded Application [{$index}]: {$app['business_name']} ({$status}) - Type: {$mhnJenisMhn}");
        }
    }
}
