<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OscKodJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_kod_jenis')->insert([
            [
                'id' => 1,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '10',
                'jns_jnsnama' => 'LESEN PREMIS PERNIAGAAN DAN IKLAN',
                'jns_jnsrgks' => 'TRED',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 2,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '20',
                'jns_jnsnama' => 'LESEN PENJAJA',
                'jns_jnsrgks' => 'PENJAJA',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 3,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '30',
                'jns_jnsnama' => 'PERMIT PERNIAGAAN',
                'jns_jnsrgks' => 'PERMIT',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 4,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '40',
                'jns_jnsnama' => 'LESEN ANJING ',
                'jns_jnsrgks' => 'ANJING',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 5,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '12',
                'jns_jnsnama' => 'LESEN HOTEL / HOMESTAY / CHALET',
                'jns_jnsrgks' => 'LESEN HOTEL /HOMESTAY',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 6,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '11',
                'jns_jnsnama' => 'LESEN PASAR',
                'jns_jnsrgks' => 'LESEN PASAR',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
            [
                'id' => 7,
                'jns_idpbt' => 'PRK_MDTM',
                'jns_kodjenis' => '03',
                'jns_jnsnama' => 'LESEN PAPAN IKLAN / BILLBOARD',
                'jns_jnsrgks' => 'LESEN IKLAN/BILLBOARD',
                'jns_statf' => 'Y',
                'jns_idate' => '2025-12-19 00:00:00',
                'jns_udate' => null,
                'jns_iuser' => 'CSM-ZUBAIRI',
                'jns_uuser' => null,
            ],
        ]);
    }
}
