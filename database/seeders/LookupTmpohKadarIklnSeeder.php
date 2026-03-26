<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Seeder for TMPOH_LSN (Tempoh Lesen) and KADAR_IKLN (Kadar Iklan) lookup data.
 *
 * Run: php artisan db:seed --class=LookupTmpohKadarIklnSeeder
 *
 * Data created in osc_slg_lookuptable:
 * - TMPOH_LSN: License duration options (6, 12, 24, 36 months) per PBT
 * - KADAR_IKLN: Advertisement rates per m² (Y=berlampu, N=tanpa lampu) per PBT
 */
class LookupTmpohKadarIklnSeeder extends Seeder
{
    private array $pbtCodes = ['PRK_MDTM', 'MBI', 'MPKK'];

    public function run(): void
    {
        $this->command->info('Seeding TMPOH_LSN and KADAR_IKLN lookup data...');

        $this->seedTmpohLesen();
        $this->seedKadarIklan();

        $this->command->info('TMPOH_LSN and KADAR_IKLN lookup data seeded successfully.');
    }

    private function seedTmpohLesen(): void
    {
        $durations = [
            ['code' => '6',  'nama' => '6 Bulan',            'seq' => 1],
            ['code' => '12', 'nama' => '12 Bulan (1 Tahun)',  'seq' => 2],
            ['code' => '24', 'nama' => '24 Bulan (2 Tahun)',  'seq' => 3],
            ['code' => '36', 'nama' => '36 Bulan (3 Tahun)',  'seq' => 4],
        ];

        $count = 0;
        foreach ($this->pbtCodes as $pbt) {
            foreach ($durations as $d) {
                DB::table('osc_slg_lookuptable')->updateOrInsert(
                    [
                        'ctl_idpbt' => $pbt,
                        'ctl_ctrlgrp' => 'TMPOH_LSN',
                        'ctl_ctrlcode' => $d['code'],
                    ],
                    [
                        'ctl_ctrlnama' => $d['nama'],
                        'ctl_ctrlstatus' => 'A',
                        'ctl_ctrlnoseq' => $d['seq'],
                        'ctl_iuser' => 'SYSTEM',
                        'ctl_idate' => Carbon::now()->format('Y-m-d'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
                $count++;
            }
        }

        $this->command->info("Created/updated {$count} TMPOH_LSN records for " . count($this->pbtCodes) . " PBTs.");
    }

    private function seedKadarIklan(): void
    {
        $rates = [
            'PRK_MDTM' => [
                ['code' => 'Y', 'nama' => '5.00', 'seq' => 1], // Berlampu RM5.00/m²
                ['code' => 'N', 'nama' => '3.00', 'seq' => 2], // Tanpa lampu RM3.00/m²
            ],
            'MBI' => [
                ['code' => 'Y', 'nama' => '6.00', 'seq' => 1],
                ['code' => 'N', 'nama' => '4.00', 'seq' => 2],
            ],
            'MPKK' => [
                ['code' => 'Y', 'nama' => '4.50', 'seq' => 1],
                ['code' => 'N', 'nama' => '2.50', 'seq' => 2],
            ],
        ];

        $count = 0;
        foreach ($rates as $pbt => $pbtRates) {
            foreach ($pbtRates as $r) {
                DB::table('osc_slg_lookuptable')->updateOrInsert(
                    [
                        'ctl_idpbt' => $pbt,
                        'ctl_ctrlgrp' => 'KADAR_IKLN',
                        'ctl_ctrlcode' => $r['code'],
                    ],
                    [
                        'ctl_ctrlnama' => $r['nama'],
                        'ctl_ctrlstatus' => 'A',
                        'ctl_ctrlnoseq' => $r['seq'],
                        'ctl_iuser' => 'SYSTEM',
                        'ctl_idate' => Carbon::now()->format('Y-m-d'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
                $count++;
            }
        }

        $this->command->info("Created/updated {$count} KADAR_IKLN records for " . count($rates) . " PBTs.");
    }
}
