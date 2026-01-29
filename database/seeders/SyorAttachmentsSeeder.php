<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyorAttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $attachments = [
            [
                'id' => 1,
                'syor_id' => 101, // Links to syor keputusan record
                'application_id' => 1,
                'original_name' => 'Dokumen_Sokongan.pdf',
                'stored_name' => '1706123456_abc123_Dokumen_Sokongan.pdf',
                'file_path' => 'syor-attachments/1/101/1706123456_abc123_Dokumen_Sokongan.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 2048576, // 2MB
                'uploaded_by' => 'ADMIN001',
                'created_at' => '2024-01-16 10:30:00',
                'updated_at' => '2024-01-16 10:30:00',
            ],
            [
                'id' => 2,
                'syor_id' => 101,
                'application_id' => 1,
                'original_name' => 'Gambar_Lokasi.jpg',
                'stored_name' => '1706123500_def456_Gambar_Lokasi.jpg',
                'file_path' => 'syor-attachments/1/101/1706123500_def456_Gambar_Lokasi.jpg',
                'mime_type' => 'image/jpeg',
                'file_size' => 1536000, // 1.5MB
                'uploaded_by' => 'ADMIN001',
                'created_at' => '2024-01-16 10:31:00',
                'updated_at' => '2024-01-16 10:31:00',
            ],
            [
                'id' => 3,
                'syor_id' => 102,
                'application_id' => 1,
                'original_name' => 'Laporan_Teknikal.docx',
                'stored_name' => '1706020000_ghi789_Laporan_Teknikal.docx',
                'file_path' => 'syor-attachments/1/102/1706020000_ghi789_Laporan_Teknikal.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'file_size' => 3072000, // 3MB
                'uploaded_by' => 'ADMIN002',
                'created_at' => '2024-01-15 14:20:00',
                'updated_at' => '2024-01-15 14:20:00',
            ],
            [
                'id' => 4,
                'syor_id' => 301,
                'application_id' => 3,
                'original_name' => 'Pelan_Tapak.pdf',
                'stored_name' => '1706890000_jkl012_Pelan_Tapak.pdf',
                'file_path' => 'syor-attachments/3/301/1706890000_jkl012_Pelan_Tapak.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 4096000, // 4MB
                'uploaded_by' => 'ADMIN002',
                'created_at' => '2024-02-02 14:15:00',
                'updated_at' => '2024-02-02 14:15:00',
            ],
        ];

        foreach ($attachments as $attachment) {
            DB::table('osc_syor_attachments')->insert($attachment);
        }
    }
}