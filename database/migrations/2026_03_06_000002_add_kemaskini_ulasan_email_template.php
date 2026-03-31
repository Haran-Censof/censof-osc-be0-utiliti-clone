<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('osc_email_templates')->insert([
            'code' => 'kemaskini_ulasan',
            'name' => 'Kemaskini Ulasan Syor Keputusan',
            'subject' => 'Ulasan Dikemaskini - {{application_number}}',
            'body' => '<p>Assalamualaikum dan Salam Sejahtera,</p>

<div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 12px; margin: 15px 0; border-radius: 4px;">
    <strong>📝 Ulasan telah dikemaskini</strong><br>
    Ulasan untuk permohonan ini telah dikemaskini dan mungkin memerlukan semakan semula.
</div>

<h3>Maklumat Permohonan</h3>
<ul>
    <li><strong>No. Siri Permohonan:</strong> {{application_number}}</li>
    <li><strong>Pemohon:</strong> {{applicant_name}}</li>
    <li><strong>Jenis Permohonan:</strong> {{application_type}}</li>
</ul>

<h3>Maklumat Kemaskini</h3>
<ul>
    <li><strong>Status:</strong> {{status}}</li>
    <li><strong>Dikemaskini Oleh:</strong> {{updated_by}}</li>
    <li><strong>Tarikh Kemaskini:</strong> {{updated_date}}</li>
    <li><strong>Ulasan Terkini:</strong> {{ulasan_text}}</li>
</ul>

<p style="text-align: center;">
    <a href="{{review_url}}" style="display: inline-block; background-color: #f59e0b; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin: 20px 0;">
        Semak Ulasan
    </a>
</p>

<p>Sila log masuk ke sistem untuk menyemak ulasan yang telah dikemaskini.</p>

<p>Sekian, terima kasih.</p>',
            'description' => 'Email sent to Ketua Jabatan when syor keputusan ulasan is updated',
            'available_placeholders' => json_encode([
                'application_number' => 'No. Siri Permohonan',
                'applicant_name' => 'Nama Pemohon',
                'application_type' => 'Jenis Permohonan',
                'status' => 'Status Ulasan',
                'updated_by' => 'Dikemaskini Oleh',
                'updated_date' => 'Tarikh Kemaskini',
                'ulasan_text' => 'Kandungan Ulasan',
                'review_url' => 'URL untuk semakan',
            ]),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('osc_email_templates')
            ->where('code', 'kemaskini_ulasan')
            ->delete();
    }
};
