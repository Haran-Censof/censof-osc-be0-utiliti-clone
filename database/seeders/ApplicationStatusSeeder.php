<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'D',
                'ctl_ctrlnama' => 'DRAF',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 1,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'B',
                'ctl_ctrlnama' => 'PERMOHONAN_BARU',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 2,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'A',
                'ctl_ctrlnama' => 'KELULUSAN_TAHAP_1',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 3,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'S',
                'ctl_ctrlnama' => 'SEMAKAN_SEMULA',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 4,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'U',
                'ctl_ctrlnama' => 'MENUNGGU_ULASAN',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 5,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'M',
                'ctl_ctrlnama' => 'MENUNGGU_MESYUARAT',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 6,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'T',
                'ctl_ctrlnama' => 'DI_TOLAK',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 7,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'K',
                'ctl_ctrlnama' => 'KEMBALI_DIPERBETULKAN',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 8,
            ],
            [
                'ctl_idpbt' => 'OSCL',
                'ctl_ctrlcode' => 'L',
                'ctl_ctrlnama' => 'LULUS_PERMOHONAN',
                'ctl_ctrlgrp' => 'MHN_STATUS',
                'ctl_ctrlstatus' => 'A',
                'ctl_ctrlnoseq' => 9,
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('osc_slg_lookuptable')->updateOrInsert(
                [
                    'ctl_idpbt' => $status['ctl_idpbt'],
                    'ctl_ctrlcode' => $status['ctl_ctrlcode'],
                    'ctl_ctrlgrp' => $status['ctl_ctrlgrp'],
                ],
                $status
            );
        }
    }
}
