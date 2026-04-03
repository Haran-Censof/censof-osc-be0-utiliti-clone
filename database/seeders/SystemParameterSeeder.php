<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_slg_sysparam')->insert([
            [
                'ID' =>1,
                'PARA_IDPBT' =>'JH_MBJB',
                'PARA_ID' =>1,
                'PARA_DESC' =>'NAMA MAJLIS',
                'PARA_VALUE' =>'MAJLIS BANDARAYA JOHOR BAHRU',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'ID' =>2,
                'PARA_IDPBT' =>'JH_MBJB',
                'PARA_ID' =>3,
                'PARA_DESC' =>'NAMA SISTEM',
                'PARA_VALUE' =>'SISTEM SISTEM OSC PELESENAN',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'ID' =>3,
                'PARA_IDPBT' =>'JH_MBJB',
                'PARA_ID' =>2,
                'PARA_DESC' =>'NAMA SINGKATAN MAJLIS',
                'PARA_VALUE' =>'MBJB',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'ID' =>4,
                'PARA_IDPBT' =>'JH_MBJB',
                'PARA_ID' =>4,
                'PARA_DESC' =>'VERSI SISTEM',
                'PARA_VALUE' =>'OSCL 1.0',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'ID' =>5,
                'PARA_IDPBT' =>'JH_MBJB',
                'PARA_ID' =>5,
                'PARA_DESC' =>'FORMAT NO AKAUN LESEN',
                'PARA_VALUE' =>'LXXXXXXX-XX',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ]
        ]);
    }
}
