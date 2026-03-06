<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * Fix mhn_nosiri values that were incorrectly set to the application ID
 * instead of the proper serial number format (e.g. PRK_MDTM26030001).
 *
 * Also updates all FK references in related tables:
 * - osc_mhn_transaksi.trn_nosiri
 * - osc_mhn_iklan.lan_nosiri
 * - osc_mhn_ulasan.uls_nosiri
 * - osc_ind_induklesen.ind_nosiri
 *
 * Safe for fresh installations — skips if tables don't exist or no broken data found.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Safety: skip if main table doesn't exist (fresh install)
        if (!Schema::hasTable('osc_mhn_permohonan')) {
            Log::info('[Migration] osc_mhn_permohonan table not found. Skipping (fresh install).');
            return;
        }

        // Safety: skip if mhn_nosiri column doesn't exist
        if (!Schema::hasColumn('osc_mhn_permohonan', 'mhn_nosiri')) {
            Log::info('[Migration] mhn_nosiri column not found. Skipping.');
            return;
        }

        DB::transaction(function () {
            // Find all applications where mhn_nosiri is purely numeric (broken)
            $broken = DB::table('osc_mhn_permohonan')
                ->whereRaw("mhn_nosiri REGEXP '^[0-9]+$'")
                ->whereNotNull('mhn_idpbt')
                ->orderBy('id')
                ->get();

            if ($broken->isEmpty()) {
                Log::info('[Migration] No broken mhn_nosiri found. Skipping.');
                return;
            }

            Log::info('[Migration] Found ' . $broken->count() . ' applications with numeric-only mhn_nosiri');

            // Find the current max sequence per PBT+YYMM prefix from existing good records
            $maxSequences = [];
            $goodRecords = DB::table('osc_mhn_permohonan')
                ->whereRaw("mhn_nosiri NOT REGEXP '^[0-9]+$'")
                ->whereRaw("mhn_nosiri REGEXP '^[A-Z]'")
                ->get(['mhn_nosiri']);

            foreach ($goodRecords as $rec) {
                if (preg_match('/^(.+?)(\d{4})$/', $rec->mhn_nosiri, $m)) {
                    $prefix = $m[1];
                    $seq = (int) $m[2];
                    $maxSequences[$prefix] = max($maxSequences[$prefix] ?? 0, $seq);
                }
            }

            // FK tables to update: [table => [nosiri_column, pbt_column]]
            $fkTables = [
                'osc_mhn_transaksi'  => ['trn_nosiri', 'trn_idpbt'],
                'osc_mhn_iklan'      => ['lan_nosiri', 'lan_idpbt'],
                'osc_mhn_ulasan'     => ['uls_nosiri', 'uls_idpbt'],
                'osc_ind_induklesen' => ['ind_nosiri', 'ind_idpbt'],
            ];

            foreach ($broken as $app) {
                $oldNosiri = $app->mhn_nosiri;
                $pbtId = $app->mhn_idpbt;

                // Determine YYMM from the application's creation date
                $idate = $app->mhn_idate;
                $yymm = $idate ? date('ym', strtotime($idate)) : date('ym');

                $prefix = $pbtId . $yymm;

                // Get next sequence for this prefix
                $nextSeq = ($maxSequences[$prefix] ?? 0) + 1;
                $maxSequences[$prefix] = $nextSeq;

                $newNosiri = $prefix . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

                Log::info("[Migration] App #{$app->id}: mhn_nosiri '{$oldNosiri}' -> '{$newNosiri}'");

                // Update the application
                DB::table('osc_mhn_permohonan')
                    ->where('id', $app->id)
                    ->update(['mhn_nosiri' => $newNosiri]);

                // Update FK tables (only if they exist)
                foreach ($fkTables as $table => [$column, $pbtCol]) {
                    if (!Schema::hasTable($table)) {
                        continue;
                    }

                    $affected = DB::table($table)
                        ->where($column, $oldNosiri)
                        ->where($pbtCol, $pbtId)
                        ->update([$column => $newNosiri]);

                    if ($affected > 0) {
                        Log::info("[Migration]   -> {$table}.{$column}: updated {$affected} rows");
                    }
                }
            }

            Log::info('[Migration] mhn_nosiri fix complete.');
        });
    }

    public function down(): void
    {
        // This migration fixes data corruption. Reverting would re-corrupt data.
        // If needed, restore from database backup.
        Log::warning('[Migration] Rollback of mhn_nosiri fix is not supported. Restore from backup if needed.');
    }
};
