<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SyorKeputusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Sample syor keputusan data for testing
        $syorKeputusanData = [
            // Application ID 1 - Multiple syor history
            [
                'application_id' => 1,
                'syor_jenis' => 'SOKONG',
                'syor_keterangan' => 'Permohonan ini memenuhi semua syarat yang ditetapkan. Pemohon telah menyediakan semua dokumen yang diperlukan dan maklumat yang lengkap.',
                'userid' => 'ADMIN001',
                'created_at' => $now->copy()->subDays(1),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'application_id' => 1,
                'syor_jenis' => 'TIDAK_SOKONG',
                'syor_keterangan' => 'Perlu dokumen tambahan untuk penilaian lanjut. Dokumen sijil keselamatan masih belum lengkap.',
                'userid' => 'ADMIN002',
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2),
            ],
            
            // Application ID 2 - No syor yet (will be empty)
            
            // Application ID 3 - Multiple syor history
            [
                'application_id' => 3,
                'syor_jenis' => 'SOKONG',
                'syor_keterangan' => 'Permohonan boleh diluluskan. Pemohon telah mematuhi semua garis panduan yang ditetapkan.',
                'userid' => 'ADMIN002',
                'created_at' => $now->copy()->subHours(2),
                'updated_at' => $now->copy()->subHours(2),
            ],
            [
                'application_id' => 3,
                'syor_jenis' => 'TIDAK_SOKONG',
                'syor_keterangan' => 'Dokumen tidak lengkap dan tidak memenuhi standard yang ditetapkan.',
                'userid' => 'ADMIN001',
                'created_at' => $now->copy()->subDays(1),
                'updated_at' => $now->copy()->subDays(1),
            ],
            [
                'application_id' => 3,
                'syor_jenis' => 'TIDAK_SOKONG',
                'syor_keterangan' => 'Menunggu laporan teknikal dari jabatan berkaitan sebelum boleh membuat keputusan.',
                'userid' => 'ADMIN003',
                'created_at' => $now->copy()->subDays(3),
                'updated_at' => $now->copy()->subDays(3),
            ],
            
            // Application ID 4 - Single syor
            [
                'application_id' => 4,
                'syor_jenis' => 'SOKONG',
                'syor_keterangan' => 'Permohonan memenuhi semua kriteria yang ditetapkan.',
                'userid' => 'ADMIN001',
                'created_at' => $now->copy()->subHours(6),
                'updated_at' => $now->copy()->subHours(6),
            ],
            
            // Application ID 5 - Not supported application
            [
                'application_id' => 5,
                'syor_jenis' => 'TIDAK_SOKONG',
                'syor_keterangan' => 'Permohonan tidak memenuhi syarat minimum yang ditetapkan. Lokasi yang dicadangkan tidak sesuai untuk jenis perniagaan ini.',
                'userid' => 'ADMIN002',
                'created_at' => $now->copy()->subDays(1)->subHours(3),
                'updated_at' => $now->copy()->subDays(1)->subHours(3),
            ],
        ];
        
        // Insert data
        DB::table('syor_keputusan')->insert($syorKeputusanData);
        
        $this->command->info('Syor Keputusan seeder completed successfully.');
        $this->command->info('Created ' . count($syorKeputusanData) . ' syor keputusan records.');
    }
}