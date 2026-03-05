<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osc_email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->comment('Template code identifier');
            $table->string('name', 100)->comment('Template name');
            $table->string('subject', 255)->comment('Email subject');
            $table->text('body')->comment('Email body content (supports placeholders)');
            $table->text('description')->nullable()->comment('Template description');
            $table->json('available_placeholders')->nullable()->comment('Available placeholders for this template');
            $table->boolean('is_active')->default(true)->comment('Is template active');
            $table->timestamps();
        });
        
        // Insert default templates
        DB::table('osc_email_templates')->insert([
            [
                'code' => 'ulasan_created',
                'name' => 'Ulasan Baru Memerlukan Kelulusan',
                'subject' => 'Ulasan Baru Memerlukan Kelulusan - {{application_number}}',
                'body' => '<p>Assalamualaikum dan Salam Sejahtera,</p>

<p>Ulasan baru telah dibuat dan memerlukan kelulusan daripada Ketua Jabatan.</p>

<h3>Maklumat Permohonan</h3>
<ul>
    <li><strong>No. Siri Permohonan:</strong> {{application_number}}</li>
    <li><strong>Pemohon:</strong> {{applicant_name}}</li>
    <li><strong>Jenis Permohonan:</strong> {{application_type}}</li>
</ul>

<h3>Maklumat Ulasan</h3>
<ul>
    <li><strong>Status:</strong> Menunggu Kelulusan</li>
    <li><strong>Dibuat Oleh:</strong> {{created_by}}</li>
    <li><strong>Tarikh:</strong> {{created_date}}</li>
    <li><strong>Ulasan:</strong> {{ulasan_text}}</li>
</ul>

<p style="text-align: center;">
    <a href="{{review_url}}" style="display: inline-block; background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin: 20px 0;">
        Semak & Lulus Ulasan
    </a>
</p>

<p>Sila log masuk ke sistem untuk menyemak dan meluluskan ulasan ini.</p>',
                'description' => 'Email sent to Ketua Jabatan when a new ulasan is created',
                'available_placeholders' => json_encode([
                    'application_number' => 'No. Siri Permohonan',
                    'applicant_name' => 'Nama Pemohon',
                    'application_type' => 'Jenis Permohonan',
                    'created_by' => 'Dibuat Oleh',
                    'created_date' => 'Tarikh Dibuat',
                    'ulasan_text' => 'Kandungan Ulasan',
                    'review_url' => 'URL untuk semakan',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ulasan_updated',
                'name' => 'Ulasan Dikemaskini',
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

<p>Sila log masuk ke sistem untuk menyemak ulasan yang telah dikemaskini.</p>',
                'description' => 'Email sent to Ketua Jabatan when an ulasan is updated',
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
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_email_templates');
    }
};
