<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Demo Data Seeder untuk idpelanggan 900101010001
 * 
 * Wujudkan data dalam:
 * - osc_mhn_permohonan (Permohonan)
 * - osc_mhn_transaksi (Transaksi Permohonan - rujuk osc_kod_niaga, osc_kod_aktiviti, osc_kod_sektor)
 * - osc_ind_induklesen (Induk Lesen)
 * - osc_ind_translesen (Transaksi Lesen)
 * - osc_bil_tmphlesen (Tempoh Bil Lesen)
 * - osc_bil_translesen (Transaksi Bil Lesen)
 */
class DemoData900101010001Seeder extends Seeder
{
    private string $idPelanggan = '900101010001';
    private string $pbtCode = 'PRK_MDTM';
    private int $noAkaun = 900001;
    private string $namaPelanggan = 'AHMAD BIN DEMO';
    private string $namaPerniagaan = 'KEDAI RUNCIT DEMO AHMAD';
    
    public function run(): void
    {
        $this->command->info("Mewujudkan demo data untuk idpelanggan: {$this->idPelanggan}");
        
        $now = Carbon::now();
        $yearMonth = $now->format('ym');
        $nosiri = $this->pbtCode . $yearMonth . '9001';
        
        // 1. Wujudkan Pelanggan (jika belum ada)
        $this->createPelanggan($now);
        
        // 2. Wujudkan Permohonan (osc_mhn_permohonan)
        $permohonanId = $this->createPermohonan($nosiri, $now);
        
        // 3. Wujudkan Transaksi Permohonan (osc_mhn_transaksi)
        $this->createMhnTransaksi($nosiri, $now);
        
        // 4. Wujudkan Induk Lesen (osc_ind_induklesen)
        $indukLesenId = $this->createIndukLesen($nosiri, $now);
        
        // 5. Wujudkan Transaksi Lesen (osc_ind_translesen)
        $this->createTransLesen($now);
        
        // 6. Wujudkan Bil Tempoh Lesen (osc_bil_tmphlesen)
        $noBil = $this->createBilTmphLesen($now);
        
        // 7. Wujudkan Transaksi Bil Lesen (osc_bil_translesen)
        $this->createBilTransLesen($noBil, $now);
        
        $this->command->info("Demo data untuk {$this->idPelanggan} berjaya diwujudkan!");
        $this->command->info("No Akaun: {$this->noAkaun}");
        $this->command->info("No Siri: {$nosiri}");
    }
    
    private function createPelanggan(Carbon $now): void
    {
        // Check if pelanggan exists
        $exists = DB::table('osc_da_pelanggan')
            ->where('plgn_idpelanggan', $this->idPelanggan)
            ->exists();
            
        if (!$exists) {
            DB::table('osc_da_pelanggan')->insert([
                'plgn_idpbt' => $this->pbtCode,
                'plgn_idpelanggan' => $this->idPelanggan,
                'plgn_pelanggannama' => $this->namaPelanggan,
                'plgn_pelangganjenis' => 'I', // Individu
                'plgn_idate' => $now,
                'plgn_iuser' => 'DEMO_SEEDER',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            
            // Alamat
            DB::table('osc_da_alamat')->insert([
                'almt_idpbt' => $this->pbtCode,
                'almt_pelangganid' => $this->idPelanggan,
                'almt_alamatid' => 1,
                'almt_alamat01' => 'NO. 123, JALAN DEMO',
                'almt_alamat02' => 'TAMAN DEMO INDAH',
                'almt_alamat03' => 'TAIPING',
                'almt_poskod' => '34000',
                'almt_notelefon' => '0123456789',
                'almt_nomborhp' => '0123456789',
                'almt_email' => 'demo@example.com',
                'almt_idate' => $now,
                'almt_iuser' => 'DEMO_SEEDER',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            
            $this->command->info("Pelanggan {$this->idPelanggan} diwujudkan.");
        } else {
            $this->command->info("Pelanggan {$this->idPelanggan} sudah wujud.");
        }
    }
    
    private function createPermohonan(string $nosiri, Carbon $now): int
    {
        // Delete existing if any
        DB::table('osc_mhn_permohonan')
            ->where('mhn_idpelanggan', $this->idPelanggan)
            ->where('mhn_noakaun', $this->noAkaun)
            ->delete();
        
        $tkhMohon = $now->copy()->subDays(30);
        $tkhLulus = $now->copy()->subDays(15);
        $tkhMula = $now->copy()->subDays(10);
        $tkhTamat = $now->copy()->addYear();
        
        $id = DB::table('osc_mhn_permohonan')->insertGetId([
            'mhn_idpbt' => $this->pbtCode,
            'mhn_jenismhn' => 'B', // Baru
            'mhn_jenis' => '1', // Kategori
            'mhn_idpelanggan' => $this->idPelanggan,
            'mhn_nama' => $this->namaPelanggan,
            'mhn_alamatpos1' => 'NO. 123, JALAN DEMO',
            'mhn_alamatpos2' => 'TAMAN DEMO INDAH',
            'mhn_alamatpos3' => '34000 TAIPING',
            'mhn_alamatpos4' => 'PERAK',
            'mhn_poskod' => '34000',
            'mhn_emel' => 'demo@example.com',
            'mhn_nomhp' => '0123456789',
            'mhn_notel' => '0123456789',
            'mhn_kodlokasi' => 1,
            'mhn_namaperniagaan' => $this->namaPerniagaan,
            'mhn_almtniaga1' => 'NO. 456, JALAN PERNIAGAAN',
            'mhn_almtniaga2' => 'PUSAT PERNIAGAAN DEMO',
            'mhn_almtniaga3' => '34000 TAIPING',
            'mhn_almtniaga4' => 'PERAK',
            'mhn_poskod2' => '34000',
            'mhn_tkmohon' => $tkhMohon,
            'mhn_tarikhlulus' => $tkhLulus,
            'mhn_statl' => 'L', // Lulus
            'mhn_tkmula' => $tkhMula,
            'mhn_tktamat' => $tkhTamat,
            'mhn_tempoh' => 12, // 12 bulan
            'mhn_msmula' => '08:00',
            'mhn_mstamat' => '22:00',
            'mhn_jenisplg' => 'I', // Individu
            'mhn_nosiri' => $nosiri,
            'mhn_norujukan' => 'DEMO/' . $now->year . '/0001',
            'mhn_noakaun' => $this->noAkaun,
            'mhn_ptjpk' => '01',
            'mhn_idate' => $now,
            'mhn_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Permohonan diwujudkan dengan ID: {$id}");
        return $id;
    }
    
    private function createMhnTransaksi(string $nosiri, Carbon $now): void
    {
        // Delete existing
        DB::table('osc_mhn_transaksi')
            ->where('trn_nosiri', $nosiri)
            ->delete();
        
        // Get sample kod niaga from database
        $kodNiaga = DB::table('osc_kod_niaga')
            ->where('nia_idpbt', $this->pbtCode)
            ->first();
        
        // Fallback values if no kod niaga found
        $kodp1 = '01'; // Sektor
        $kodp2 = '001'; // Aktiviti  
        $kodp3 = '01'; // Niaga
        $trnKodniaga = null;
        
        if ($kodNiaga) {
            $trnKodniaga = $kodNiaga->nia_kodniaga ?? null;
        }
        
        DB::table('osc_mhn_transaksi')->insert([
            'trn_idpbt' => $this->pbtCode,
            'trn_nosiri' => $nosiri,
            'trn_akaun' => $this->noAkaun,
            'trn_utama' => 1, // Utama
            'trn_kodp1' => $kodp1,
            'trn_kodp2' => $kodp2,
            'trn_kodp3' => $kodp3,
            'trn_tmbhkurng' => 0.00,
            'trn_scagr' => 'T', // Tidak ada cagaran
            'trn_statt' => 'A', // Aktif
            'trn_idate' => $now,
            'trn_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Transaksi permohonan diwujudkan.");
    }
    
    private function createIndukLesen(string $nosiri, Carbon $now): int
    {
        // Delete existing
        DB::table('osc_ind_induklesen')
            ->where('ind_idpelanggan', $this->idPelanggan)
            ->where('ind_akaun', $this->noAkaun)
            ->delete();
        
        $tkhMohon = $now->copy()->subDays(30);
        $tkhLulus = $now->copy()->subDays(15);
        $tkhMula = $now->copy()->subDays(10);
        $tkhTamat = $now->copy()->addYear();
        
        $id = DB::table('osc_ind_induklesen')->insertGetId([
            'ind_idpbt' => $this->pbtCode,
            'ind_akaun' => $this->noAkaun,
            'ind_idpelanggan' => $this->idPelanggan,
            'ind_nosiri' => $nosiri,
            'ind_jenisplg' => 'I', // Individu
            'ind_tkhmsyuarat' => $tkhLulus,
            'ind_ptjpk' => '01',
            'ind_kodlokasi' => 1,
            'ind_namaperniagaan' => $this->namaPerniagaan,
            'ind_almtperniagaan' => 'NO. 456, JALAN PERNIAGAAN, PUSAT PERNIAGAAN DEMO, 34000 TAIPING, PERAK',
            'ind_norujukan' => 'DEMO/' . $now->year . '/0001',
            'ind_tkhmohon' => $tkhMohon,
            'ind_tkhlulus' => $tkhLulus,
            'ind_katniaga' => 1,
            'ind_statl' => 'A', // Aktif
            'ind_tkhmula' => $tkhMula,
            'ind_tkhtamat' => $tkhTamat,
            'ind_tempoh' => 12,
            'ind_notelefon' => '0123456789',
            'ind_msmula' => '08:00',
            'ind_mstamat' => '22:00',
            'ind_idate' => $now,
            'ind_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Induk Lesen diwujudkan dengan ID: {$id}");
        return $id;
    }
    
    private function createTransLesen(Carbon $now): void
    {
        // Delete existing
        DB::table('osc_ind_translesen')
            ->where('trn_idpbt', $this->pbtCode)
            ->where('trn_akaun', $this->noAkaun)
            ->delete();
        
        DB::table('osc_ind_translesen')->insert([
            'trn_idpbt' => $this->pbtCode,
            'trn_akaun' => $this->noAkaun,
            'trn_sequtama' => 1,
            'trn_kodniaga1' => '01', // Sektor
            'trn_kodniaga2' => '001', // Aktiviti
            'trn_kodniaga3' => '01', // Niaga
            'trn_tmbhkurng' => 0.00,
            'trn_statcagar' => 'T', // Tidak
            'trn_stattrans' => 'A', // Aktif
            'trn_idate' => $now,
            'trn_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Transaksi Lesen diwujudkan.");
    }
    
    private function createBilTmphLesen(Carbon $now): string
    {
        $noBil = 'BIL' . $now->format('Ymd') . '0001';
        
        // Delete existing
        DB::table('osc_bil_tmphlesen')
            ->where('bl1_idpbt', $this->pbtCode)
            ->where('bl1_noakaun', $this->noAkaun)
            ->delete();
        
        $tkhBil = $now->copy()->subDays(10);
        $tempoh = $now->copy()->addYear();
        
        DB::table('osc_bil_tmphlesen')->insert([
            'bl1_idpbt' => $this->pbtCode,
            'bl1_noakaun' => $this->noAkaun,
            'bl1_nombil' => $noBil,
            'bl1_tkhbil' => $tkhBil,
            'bl1_tempoh' => $tempoh,
            'bl1_statf' => 'N', // Baru
            'bl1_idate' => $now,
            'bl1_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Bil Tempoh Lesen diwujudkan: {$noBil}");
        return $noBil;
    }
    
    private function createBilTransLesen(string $noBil, Carbon $now): void
    {
        // Delete existing
        DB::table('osc_bil_translesen')
            ->where('bl2_idpbt', $this->pbtCode)
            ->where('bl2_noakaun', $this->noAkaun)
            ->delete();
        
        // Transaksi 1: Yuran Lesen
        DB::table('osc_bil_translesen')->insert([
            'bl2_idpbt' => $this->pbtCode,
            'bl2_noakaun' => $this->noAkaun,
            'bl2_transaksi' => '21001', // Kod transaksi yuran lesen
            'bl2_nombil' => $noBil,
            'bl2_amaun' => 150.00,
            'bl2_statf' => 'N', // Baru
            'bl2_idate' => $now,
            'bl2_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        // Transaksi 2: Duti Setem (jika ada)
        DB::table('osc_bil_translesen')->insert([
            'bl2_idpbt' => $this->pbtCode,
            'bl2_noakaun' => $this->noAkaun,
            'bl2_transaksi' => '21002', // Kod transaksi duti setem
            'bl2_nombil' => $noBil,
            'bl2_amaun' => 10.00,
            'bl2_statf' => 'N',
            'bl2_idate' => $now,
            'bl2_iuser' => 'DEMO_SEEDER',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        $this->command->info("Transaksi Bil Lesen diwujudkan (2 rekod).");
    }
}
