<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OscKodImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
<<<<<<< HEAD
     */
    public function run(): void
    {
=======
     * 
     * Siri Image untuk PRK_MDTM:
     * - 10001: Logo Majlis (PRK_MDTM_LOGO.png)
     * - 10002: Header Bil Lesen (PRK_MDTM_BIL.jpg)
     * - 10003: Letter Head (PRK_MDTM_LATTERHEAD.jpg)
     * - 10004: Logo 2
     * - 10005: Tandatangan Digital (PRK_MDTM_TANDATANGAN_DIGITAL.png)
     */
    public function run(): void
    {
        $imagesPath = database_path('seeders/images');

        // Load imej dari folder
        $images = [
            10001 => $this->loadImage($imagesPath . '/PRK_MDTM_LOGO.png'),
            10002 => $this->loadImage($imagesPath . '/PRK_MDTM_BIL.jpg'),
            10003 => $this->loadImage($imagesPath . '/PRK_MDTM_LATTERHEAD.jpg'),
            10005 => $this->loadImage($imagesPath . '/PRK_MDTM_TANDATANGAN_DIGITAL.png'),
        ];

>>>>>>> upstream/main
        DB::table('osc_kod_image')->insert([
            [
                'id' => 1,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10001,
                'img_imgnama' => 'LOGO MAJLIS',
<<<<<<< HEAD
                'img_imgimge' => null,
=======
                'img_imgimge' => $images[10001],
>>>>>>> upstream/main
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
<<<<<<< HEAD
                'img_imgimge' => null,
=======
                'img_imgimge' => $images[10002],
>>>>>>> upstream/main
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
<<<<<<< HEAD
                'img_imgimge' => null,
=======
                'img_imgimge' => $images[10003],
>>>>>>> upstream/main
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
<<<<<<< HEAD
        ]);
    }
=======
            [
                'id' => 5,
                'img_idpbt' => 'PRK_MDTM',
                'img_imgsiri' => 10005,
                'img_imgnama' => 'TANDATANGAN DIGITAL',
                'img_imgimge' => $images[10005],
                'img_statf' => 'Y',
                'img_idate' => '2025-12-25 00:00:00',
                'img_udate' => null,
                'img_iuser' => 'CSM_ZUBAIRI',
                'img_uuser' => null,
            ],
        ]);
    }

    /**
     * Load imej dari path jika wujud
     */
    private function loadImage(string $path): ?string
    {
        if (file_exists($path)) {
            return file_get_contents($path);
        }
        
        return null;
    }
>>>>>>> upstream/main
}
