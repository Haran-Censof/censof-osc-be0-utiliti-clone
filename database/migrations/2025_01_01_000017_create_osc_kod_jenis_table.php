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
        Schema::create('osc_kod_jenis', function (Blueprint $table) {
            $table->string('jns_kdsrpbt', 10)->comment('id pbt');
            $table->string('jns_kodundg', 4)->comment('kod undang-undang kecil pelesenan');
            $table->string('jns_kodjenis', 2)->comment('kod jenis');
            $table->string('jns_jnsnama', 100)->nullable()->comment('keterangan');
            $table->string('jns_jnsrgks', 40)->nullable()->comment('keterangan ringkas');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite primary key
            $table->primary(['jns_kdsrpbt', 'jns_kodundg', 'jns_kodjenis'], 'pk_osc_kodjenis');

            // Add indexes
            $table->index('jns_kdsrpbt');
            $table->index(['jns_kdsrpbt', 'jns_kodundg']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_kod_jenis');
    }
};
