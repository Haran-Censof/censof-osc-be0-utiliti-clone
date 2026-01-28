<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OscKodNiagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_kod_niaga')->insert([
            [
                'id' => 34,
                'nia_idpbt' => 'PRK_MDTM',
                'nia_kodundang' => '05',
                'nia_kodaktiviti' => 'C0011',
                'nia_kodniaga' => '05C001100004',
                'nia_transaksi' => '21011',
                'nia_keterangan' => 'PENYIMPANAN BATU PERMATA & LOGAM KURANG DARI 93M2',
                'nia_ringkas' => 'SIMPAN BATU PERMATA & LOGAM KURANG 93M2',
                'nia_kdrbndr' => 180,
                'nia_kdrluar' => null,
                'nia_kdrlain' => null,
                'nia_stbyrblk' => 'T',
                'nia_stdiscnt' => 'T',
                'nia_discount' => '0',
                'nia_risiko' => 'R',
                'nia_statcgrn' => 'Y',
                'nia_amauncgrn' => 0,
                'nia_halal' => null,
                'nia_tmpoh' => 1,
                'nia_gldebit' => null,
                'nia_glkredit' => null,
                'nia_statf' => 'Y',
                'nia_oldcode' => '0520668',
                'nia_idate' => '2025-12-18 00:00:00',
                'nia_udate' => null,
                'nia_iuser' => 'zubairi',
                'nia_uuser' => null,
            ],
            [
                'id' => 35,
                'nia_idpbt' => 'PRK_MDTM',
                'nia_kodundang' => '05',
                'nia_kodaktiviti' => 'C0011',
                'nia_kodniaga' => '05C001100005',
                'nia_transaksi' => '21011',
                'nia_keterangan' => 'MEMPROSES BATU PERMATA DAN LOGAM 93M2-186M2',
                'nia_ringkas' => 'PROSES BATU PERMATA DAN LOGAM 93-186M2',
                'nia_kdrbndr' => 240,
                'nia_kdrluar' => null,
                'nia_kdrlain' => null,
                'nia_stbyrblk' => 'T',
                'nia_stdiscnt' => 'T',
                'nia_discount' => '0',
                'nia_risiko' => 'R',
                'nia_statcgrn' => 'Y',
                'nia_amauncgrn' => 0,
                'nia_halal' => null,
                'nia_tmpoh' => 1,
                'nia_gldebit' => null,
                'nia_glkredit' => null,
                'nia_statf' => 'Y',
                'nia_oldcode' => '0520669',
                'nia_idate' => '2025-12-18 00:00:00',
                'nia_udate' => null,
                'nia_iuser' => 'zubairi',
                'nia_uuser' => null,
            ],
            [
                'id' => 36,
                'nia_idpbt' => 'PRK_MDTM',
                'nia_kodundang' => '05',
                'nia_kodaktiviti' => 'C0011',
                'nia_kodniaga' => '05C001100006',
                'nia_transaksi' => '21011',
                'nia_keterangan' => 'PENYIMPANAN BATU PERMATA & LOGAM MELEBIHI 186M2',
                'nia_ringkas' => 'SIMPAN BATU PERMATA & LOGAM LEBIH 186M2',
                'nia_kdrbndr' => 360,
                'nia_kdrluar' => null,
                'nia_kdrlain' => null,
                'nia_stbyrblk' => 'T',
                'nia_stdiscnt' => 'T',
                'nia_discount' => '0',
                'nia_risiko' => 'R',
                'nia_statcgrn' => 'Y',
                'nia_amauncgrn' => 0,
                'nia_halal' => null,
                'nia_tmpoh' => 1,
                'nia_gldebit' => null,
                'nia_glkredit' => null,
                'nia_statf' => 'Y',
                'nia_oldcode' => '0520670',
                'nia_idate' => '2025-12-18 00:00:00',
                'nia_udate' => null,
                'nia_iuser' => 'zubairi',
                'nia_uuser' => null,
            ],
            // NOTE: This seeder has been restructured to match JSON data exactly
            // Original seeder had wrong structure with nia_kodniaga1,2,3 fields
            // JSON structure is correct with single nia_kodniaga field
            // Added missing fields: nia_amauncgrn, nia_oldcode
            // All 1619 records should be added here from JSON data
        ]);
    }
}
