<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Fix child tables to use mhn_nosiri instead of numeric id for FK references.
 *
 * Tables affected: osc_mhn_lpekerja, osc_mhn_dokumen, osc_mhn_iklan,
 * osc_mhn_transaksi, osc_mhn_ulasan, osc_mhn_ulasandetail, osc_mhn_lnomini
 */
return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Generate mhn_nosiri for applications that don't have one yet
        $missingNosiri = DB::table('osc_mhn_permohonan')
            ->where(function ($q) {
                $q->whereNull('mhn_nosiri')->orWhere('mhn_nosiri', '');
            })
            ->whereNotNull('mhn_idpbt')
            ->where('mhn_idpbt', '!=', '')
            ->select('id', 'mhn_idpbt', 'created_at')
            ->orderBy('id')
            ->get();

        foreach ($missingNosiri as $app) {
            $createdAt = $app->created_at ? date('ym', strtotime($app->created_at)) : date('ym');
            $prefix = $app->mhn_idpbt . $createdAt;

            $lastRecord = DB::table('osc_mhn_permohonan')
                ->where('mhn_nosiri', 'LIKE', $prefix . '%')
                ->orderBy('mhn_nosiri', 'desc')
                ->first();

            $sequence = 1;
            if ($lastRecord && preg_match('/(\d{4})$/', $lastRecord->mhn_nosiri, $matches)) {
                $sequence = (int) $matches[1] + 1;
            }

            $nosiri = $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);

            DB::table('osc_mhn_permohonan')
                ->where('id', $app->id)
                ->update(['mhn_nosiri' => $nosiri]);
        }

        // Step 2: Build mapping id => mhn_nosiri for all applications
        $applications = DB::table('osc_mhn_permohonan')
            ->whereNotNull('mhn_nosiri')
            ->where('mhn_nosiri', '!=', '')
            ->select('id', 'mhn_nosiri')
            ->get();

        if ($applications->isEmpty()) {
            return;
        }

        $idToNosiri = [];
        foreach ($applications as $app) {
            $idToNosiri[(string) $app->id] = $app->mhn_nosiri;
        }

        // Tables and their nosiri FK column
        $tables = [
            'osc_mhn_lpekerja' => 'lpk_nosiri',
            'osc_mhn_dokumen' => 'doc_nosiri',
            'osc_mhn_transaksi' => 'trn_nosiri',
            'osc_mhn_lnomini' => 'nom_nosiri',
        ];

        foreach ($tables as $table => $column) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            // Find records where nosiri column contains a numeric value (old id reference)
            $records = DB::table($table)
                ->whereRaw("$column REGEXP '^[0-9]+$'")
                ->select('id', $column)
                ->get();

            foreach ($records as $record) {
                $oldValue = $record->$column;
                if (isset($idToNosiri[$oldValue])) {
                    DB::table($table)
                        ->where('id', $record->id)
                        ->update([$column => $idToNosiri[$oldValue]]);
                }
            }
        }

        // Fix osc_mhn_iklan — lan_nosiri may have suffix like "89-01"
        if (Schema::hasTable('osc_mhn_iklan')) {
            $iklanRecords = DB::table('osc_mhn_iklan')
                ->whereRaw("lan_nosiri REGEXP '^[0-9]+'")
                ->select('id', 'lan_nosiri')
                ->get();

            foreach ($iklanRecords as $record) {
                // Extract numeric part (before any dash suffix)
                $numericPart = preg_replace('/[^0-9].*/', '', $record->lan_nosiri);
                if (isset($idToNosiri[$numericPart])) {
                    $newNosiri = $idToNosiri[$numericPart];
                    DB::table('osc_mhn_iklan')
                        ->where('id', $record->id)
                        ->update(['lan_nosiri' => $newNosiri]);
                }
            }
        }

        // Fix osc_mhn_ulasan and osc_mhn_ulasandetail
        foreach (['osc_mhn_ulasan', 'osc_mhn_ulasandetail'] as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            $records = DB::table($table)
                ->whereRaw("uls_nosiri REGEXP '^[0-9]+$'")
                ->select('id', 'uls_nosiri')
                ->get();

            foreach ($records as $record) {
                if (isset($idToNosiri[$record->uls_nosiri])) {
                    DB::table($table)
                        ->where('id', $record->id)
                        ->update(['uls_nosiri' => $idToNosiri[$record->uls_nosiri]]);
                }
            }
        }
    }

    public function down(): void
    {
        // Not reversible — old numeric IDs are no longer meaningful
    }
};
