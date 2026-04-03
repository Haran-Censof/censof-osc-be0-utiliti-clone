<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Fix sp_ins_translesen column references.
     *
     * The SP was incorrectly referencing renamed/non-existent columns from osc_mhn_transaksi:
     * - trn_kodjenis, trn_kodsektor, trn_kodaktiviti → actual source columns are trn_kodp1, trn_kodp2, trn_kodp3
     * - trn_kodniaga, trn_risiko → do not exist in osc_mhn_transaksi, should be NULL
     * - trn_tmbhkurng → actual source column is trn_tambh
     *
     * Also applies COLLATE utf8mb4_unicode_ci to WHERE clauses to prevent collation mismatch.
     * Also removes explicit `id` primary key inserts to let MySQL auto-increment.
     */
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_translesen;
            CREATE PROCEDURE sp_ins_translesen(
                IN p_id1 VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_idpbt VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_nosiri VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
            )
            BEGIN
                INSERT INTO osc_ind_translesen
                (trn_idpbt, trn_akaun, trn_sequtama, trn_kodjenis,
                trn_kodsektor, trn_kodaktiviti, trn_kodniaga, trn_risiko,
                trn_tmbhkurng, trn_statcagar, trn_akauncagar,
                trn_tarikhcagar, trn_resitcagar, trn_amauncagar,
                trn_stattrans, trn_oldcode, trn_nosiri, trn_idate, trn_udate,
                trn_iuser, trn_uuser)
                SELECT
                    p_idpbt, p_noakaun, trn_utama, trn_kodp1,
                    trn_kodp2, trn_kodp3, NULL,
                    NULL, trn_tambh, trn_scagr,
                    NULL, NULL, NULL, NULL, trn_statt, NULL,
                    p_nosiri, trn_idate, NOW(), trn_iuser, p_uuser
                FROM osc_mhn_transaksi
                WHERE trn_idpbt = p_idpbt COLLATE utf8mb4_unicode_ci
                AND trn_nosiri = p_nosiri COLLATE utf8mb4_unicode_ci;
            END;
        ");
    }

    /**
     * Reverse the migrations — restore previous version of sp_ins_translesen.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_translesen;
            CREATE PROCEDURE sp_ins_translesen(
                IN p_id1 VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_idpbt VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_nosiri VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
            )
            BEGIN
                INSERT INTO osc_ind_translesen
                (trn_idpbt, trn_akaun, trn_sequtama, trn_kodjenis,
                trn_kodsektor, trn_kodaktiviti, trn_kodniaga, trn_risiko,
                trn_tmbhkurng, trn_statcagar, trn_akauncagar,
                trn_tarikhcagar, trn_resitcagar, trn_amauncagar,
                trn_stattrans, trn_oldcode, trn_nosiri, trn_idate, trn_udate,
                trn_iuser, trn_uuser)
                SELECT
                    p_idpbt, p_noakaun, trn_utama, trn_kodjenis,
                    trn_kodsektor, trn_kodaktiviti, trn_kodniaga,
                    trn_risiko, trn_tmbhkurng, trn_scagr,
                    NULL, NULL, NULL, NULL, trn_statt, NULL,
                    p_nosiri, trn_idate, NOW(), trn_iuser, p_uuser
                FROM osc_mhn_transaksi
                WHERE trn_idpbt = p_idpbt COLLATE utf8mb4_unicode_ci
                AND trn_nosiri = p_nosiri COLLATE utf8mb4_unicode_ci;
            END;
        ");
    }
};
