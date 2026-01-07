<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OscKodListhitamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_kod_listhitam')->insert([
            [
                'id' => 1,
                'htm_idpbt' => 'PRK_MDTM',
                'htm_kodkategori' => '1',
                'htm_keterangan' => 'BANKRAP',
                'htm_idate' => '2025-12-25 00:00:00',
                'htm_udate' => null,
                'htm_iuser' => 'CSM_ZUBAIRI',
                'htm_uuser' => null,
            ],
            [
                'id' => 2,
                'htm_idpbt' => 'PRK_MDTM',
                'htm_kodkategori' => '2',
                'htm_keterangan' => 'GILA',
                'htm_idate' => '2025-12-25 00:00:00',
                'htm_udate' => null,
                'htm_iuser' => 'CSM_ZUBAIRI',
                'htm_uuser' => null,
            ],
            [
                'id' => 3,
                'htm_idpbt' => 'PRK_MDTM',
                'htm_kodkategori' => '3',
                'htm_keterangan' => 'HUTANG MELEBIHI LIMIT DITETAPKAN',
                'htm_idate' => '2025-12-25 00:00:00',
                'htm_udate' => null,
                'htm_iuser' => 'CSM_ZUBAIRI',
                'htm_uuser' => null,
            ],
        ]);
    }
}
