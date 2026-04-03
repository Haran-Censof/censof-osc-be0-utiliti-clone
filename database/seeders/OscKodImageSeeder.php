<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OscKodImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_kod_image')->insert([
            [
                'id' => 1,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10001,
                'img_imgnama' => 'LOGO MAJLIS',
                'img_imgimge' => null,
                'img_statf' => 'Y',
                'img_idate' => '2025-12-25 00:00:00',
                'img_udate' => null,
                'img_iuser' => 'CSM_ZUBAIRI',
                'img_uuser' => null,
            ],
            [
                'id' => 2,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10002,
                'img_imgnama' => 'HEADER BIL LESEN',
                'img_imgimge' => null,
                'img_statf' => 'Y',
                'img_idate' => '2025-12-25 00:00:00',
                'img_udate' => null,
                'img_iuser' => 'CSM_ZUBAIRI',
                'img_uuser' => null,
            ],
            [
                'id' => 3,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10003,
                'img_imgnama' => 'LETTER HEAD',
                'img_imgimge' => null,
                'img_statf' => 'Y',
                'img_idate' => '2025-12-25 00:00:00',
                'img_udate' => null,
                'img_iuser' => 'CSM_ZUBAIRI',
                'img_uuser' => null,
            ],
            [
                'id' => 4,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10004,
                'img_imgnama' => 'LOGO 2',
                'img_imgimge' => null,
                'img_statf' => 'Y',
                'img_idate' => '2025-12-25 00:00:00',
                'img_udate' => null,
                'img_iuser' => 'CSM_ZUBAIRI',
                'img_uuser' => null,
            ],
        ]);
    }
}
