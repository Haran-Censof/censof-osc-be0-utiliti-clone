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
            ],
            // PRK_MDTM - para_id 1 hingga 4
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>1,
                'PARA_DESC' =>'NAMA MAJLIS',
                'PARA_VALUE' =>'MAJLIS DAERAH TANJONG MALIM',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>2,
                'PARA_DESC' =>'NAMA SINGKATAN MAJLIS',
                'PARA_VALUE' =>'MDTM',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>3,
                'PARA_DESC' =>'NAMA SISTEM',
                'PARA_VALUE' =>'SISTEM SISTEM OSC PELESENAN',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>4,
                'PARA_DESC' =>'VERSI SISTEM',
                'PARA_VALUE' =>'iPayment',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            // PRK_MDTM - para_id 10 hingga 25
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>10,
                'PARA_DESC' =>'NAMA YDP',
                'PARA_VALUE' =>'(MOHD IKRAM BIN AHMAD)',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>11,
                'PARA_DESC' =>'JAWATAN YDP',
                'PARA_VALUE' =>'YANG DIPERTUA',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>12,
                'PARA_DESC' =>'NAMA PEG.',
                'PARA_VALUE' =>'(HAJAH SITI AIDA BINTI RASHIDI)',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>13,
                'PARA_DESC' =>'JAWATAN PEG.',
                'PARA_VALUE' =>'PEGAWAI KESIHATAN PERSEKITARAN',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>14,
                'PARA_DESC' =>'BP',
                'PARA_VALUE' =>'b.p. YANG DIPERTUA',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>15,
                'PARA_DESC' =>'POSKOD',
                'PARA_VALUE' =>'35900 TANJONG MALIM',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>16,
                'PARA_DESC' =>'NEGERI',
                'PARA_VALUE' =>'PERAK DARUL RIDZUAN',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>20,
                'PARA_DESC' =>'MESEJ BIL',
                'PARA_VALUE' =>'SILA PERBAHARUI LESEN PERNIAGAAN DALAM TEMPOH 7 HA...',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>21,
                'PARA_DESC' =>'SIGN',
                'PARA_VALUE' =>'Saya yang menjalankan amanah,',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>22,
                'PARA_DESC' =>'MOTTO 1',
                'PARA_VALUE' =>'"MALAYSIA MADANI"',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>23,
                'PARA_DESC' =>'MOTTO 2',
                'PARA_VALUE' =>'"BERKHIDMAT UNTUK NEGARA"',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>24,
                'PARA_DESC' =>'MOTTO 3',
                'PARA_VALUE' =>'',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ],
            [
                'PARA_IDPBT' =>'PRK_MDTM',
                'PARA_ID' =>25,
                'PARA_DESC' =>'MOTTO 4',
                'PARA_VALUE' =>'',
                'PARA_IUSER' =>null,
                'PARA_UUSER' =>null
            ]
            [
                'PARA_IDPBT' => 'PRK_MDTM',
                'PARA_ID' => 26,
                'PARA_DESC' => 'STATUS JANA SIJIL LESEN(P-PEGAWAI,S-SISTEM)', 
                'PARA_VALUE' => 'P', 
                'PARA_IUSER' => null,
                'PARA_UUSER' => null
            ],

        ]);
    }
}
