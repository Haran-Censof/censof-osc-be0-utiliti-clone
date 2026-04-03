<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatilSeeder extends Seeder
{
    /**
     * Seed kadar patil ke lookup table.
     * ctl_ctrlgrp = PATIL
     * ctl_ctrlcode = PBT_KOD (OSCL = default, atau kod PBT spesifik)
     * ctl_ctrlnama = nilai kadar patil (fixed price)
     * ctl_ctrlstatus = A (Aktif) / T (Tidak Aktif)
     */
    public function run(): void
    {
        $patilRecords = [
            [
                'CTL_IDPBT' => 'OSCL',
                'CTL_CTRLCODE' => 'OSCL',
                'CTL_CTRLNAMA' => '10.00',
                'CTL_CTRLGRP' => 'PATIL',
                'CTL_CTRLSTATUS' => 'A',
                'CTL_CTRLNOSEQ' => 1,
                'CTL_IUSER' => null,
                'CTL_UUSER' => null,
                'CTL_IDATE' => now()->toDateString(),
                'CTL_UDATE' => null,
            ],
            [
                'CTL_IDPBT' => 'PRK_MDTM',
                'CTL_CTRLCODE' => 'PRK_MDTM',
                'CTL_CTRLNAMA' => '10.00',
                'CTL_CTRLGRP' => 'PATIL',
                'CTL_CTRLSTATUS' => 'A',
                'CTL_CTRLNOSEQ' => 2,
                'CTL_IUSER' => null,
                'CTL_UUSER' => null,
                'CTL_IDATE' => now()->toDateString(),
                'CTL_UDATE' => null,
            ],
        ];

        foreach ($patilRecords as $record) {
            DB::table('osc_slg_lookuptable')->updateOrInsert(
                [
                    'CTL_CTRLGRP' => $record['CTL_CTRLGRP'],
                    'CTL_CTRLCODE' => $record['CTL_CTRLCODE'],
                ],
                $record
            );
        }
    }
}
