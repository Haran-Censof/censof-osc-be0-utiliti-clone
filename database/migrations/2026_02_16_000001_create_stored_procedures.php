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
        // get_no_akaun function
        DB::unprepared("
            DROP FUNCTION IF EXISTS get_no_akaun;
        ");

        // sp_ins_nominilesen
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_nominilesen;
            CREATE PROCEDURE sp_ins_nominilesen(
                IN p_id1 VARCHAR(255),
                IN p_idpbt VARCHAR(255),
                IN p_nosiri VARCHAR(255),
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255)
            )
            BEGIN
                INSERT INTO osc_ind_lnomini
                (id, nom_idpbt, nom_akaun, nom_idplgnom1, nom_namanom1,
                nom_trkhtmt1, nom_trkhkpm1, nom_idplgnom2, nom_namanom2,
                nom_trkhtmt2, nom_trkhkpm2, nom_idplgnom3, nom_namanom3,
                nom_trkhtmt3, nom_trkhkpm3, nom_idplgnom4, nom_namanom4,
                nom_trkhtmt4, nom_trkhkpm4, nom_idplgnom5, nom_namanom5,
                nom_trkhtmt5, nom_trkhkpm5, nom_nosiri, nom_idate,
                nom_udate, nom_iuser, nom_uuser)
                SELECT
                    p_id1, p_idpbt, p_noakaun, nom_idplgnom1, nom_namanom1,
                    nom_trkhtmt1, nom_trkhkpm1, nom_idplgnom2, nom_namanom2,
                    nom_trkhtmt2, nom_trkhkpm2, nom_idplgnom3, nom_namanom3,
                    nom_trkhtmt3, nom_trkhkpm3, nom_idplgnom4, nom_namanom4,
                    nom_trkhtmt4, nom_trkhkpm4, nom_idplgnom5, nom_namanom5,
                    nom_trkhtmt5, nom_trkhkpm5, p_nosiri,
                    nom_idate, NOW(), nom_iuser, p_uuser
                FROM osc_mhn_lnomini
                WHERE nom_idpbt = p_idpbt
                AND nom_nosiri = p_nosiri;
            END;
        ");

        // sp_ins_translesen
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_translesen;
            CREATE PROCEDURE sp_ins_translesen(
                IN p_id1 VARCHAR(255),
                IN p_idpbt VARCHAR(255),
                IN p_nosiri VARCHAR(255),
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255)
            )
            BEGIN
                INSERT INTO osc_ind_translesen
                (id, trn_idpbt, trn_akaun, trn_sequtama, trn_kodjenis,
                trn_kodsektor, trn_kodaktiviti, trn_kodniaga, trn_risiko,
                trn_tmbhkurng, trn_statcagar, trn_akauncagar,
                trn_tarikhcagar, trn_resitcagar, trn_amauncagar,
                trn_stattrans, trn_oldcode, trn_idate, trn_udate,
                trn_iuser, trn_uuser)
                SELECT
                    p_id1, p_idpbt, p_noakaun, trn_utama, trn_kodjenis,
                    trn_kodsektor, trn_kodaktiviti, trn_kodniaga,
                    trn_risiko, trn_tambh, trn_scagr,
                    NULL, NULL, NULL, NULL, trn_statt, NULL,
                    trn_idate, NOW(), trn_iuser, p_uuser
                FROM osc_mhn_transaksi
                WHERE trn_idpbt = p_idpbt
                AND trn_nosiri = p_nosiri;
            END;
        ");

        // sp_ins_iklanlesen
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_iklanlesen;
            CREATE PROCEDURE sp_ins_iklanlesen(
                IN p_id1 VARCHAR(255),
                IN p_idpbt VARCHAR(255),
                IN p_nosiri VARCHAR(255),
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255)
            )
            BEGIN
                INSERT INTO osc_ind_iklanlesen
                (id, lan_idpbt, lan_akaun, lan_rujukan, lan_tkhmula,
                lan_tkhtmt, lan_amaun, lan_lentang, lan_berlampu,
                lan_stataktif, lan_panjang, lan_lebar, lan_tempat,
                lan_keterangan, lan_tkhbatal, lan_statf,
                lan_idate, lan_udate, lan_iuser, lan_uuser)
                SELECT
                    p_id1, p_idpbt, p_noakaun, lan_rujuk, lan_mulai,
                    lan_tamti, lan_amaun, lan_keadn, lan_stalp,
                    lan_aktif, lan_panjg, lan_lebar, lan_tempt,
                    lan_keter, lan_batal, lan_statf,
                    lan_idate, NOW(), lan_iuser, p_uuser
                FROM osc_mhn_iklan
                WHERE lan_idpbt = p_idpbt
                AND lan_nosiri = p_nosiri;
            END;
        ");

        // sp_ins_gambarlesen
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_gambarlesen;
            CREATE PROCEDURE sp_ins_gambarlesen(
                IN p_id1 VARCHAR(255),
                IN p_idpbt VARCHAR(255),
                IN p_nosiri VARCHAR(255),
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255)
            )
            BEGIN
                INSERT INTO osc_ind_gambarlesen
                (id, gbr_idpbt, gbr_akaun, gbr_imsiri, gbr_namafail,
                gbr_pathfile, gbr_nosiri, gbr_idate, gbr_udate, gbr_iuser,
                gbr_uuser)
                SELECT
                    p_id1, p_idpbt, p_noakaun, gbr_imsiri, gbr_namafail,
                    gbr_pathfile, p_nosiri, gbr_idate, NOW(), gbr_iuser, p_uuser
                FROM osc_mhn_gambar
                WHERE gbr_idpbt = p_idpbt
                AND gbr_nosiri = p_nosiri;
            END;
        ");

        // sp_ins_dokumenlesen
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_ins_dokumenlesen;
            CREATE PROCEDURE sp_ins_dokumenlesen(
                IN p_id1 VARCHAR(255),
                IN p_idpbt VARCHAR(255),
                IN p_nosiri VARCHAR(255),
                IN p_noakaun INT,
                IN p_uuser VARCHAR(255)
            )
            BEGIN
                INSERT INTO osc_ind_dokumenlesen
                (id, doc_idpbt, doc_akaun, doc_dcsiri, doc_dokumen, doc_catatan,
                doc_nosiri, doc_idate, doc_udate, doc_iuser, doc_uuser)
                SELECT
                    p_id1, p_idpbt, p_noakaun, doc_dcsiri, doc_dokumen, doc_catatan,
                    doc_nosiri, doc_idate, NOW(), doc_iuser, p_uuser
                FROM osc_mhn_dokumen
                WHERE doc_idpbt = p_idpbt
                AND doc_nosiri = p_nosiri;
            END;
        ");

        // sp_ins_induklesen (Main Procedure)
        DB::unprepared("
             DROP PROCEDURE IF EXISTS sp_ins_induklesen;
             CREATE PROCEDURE sp_ins_induklesen(
                 IN p_id1 BIGINT,
                 IN p_idpbt VARCHAR(255),
                 IN p_nosiri VARCHAR(255),
                 IN p_uuser VARCHAR(255)
             )
             BEGIN
                 DECLARE done INT DEFAULT FALSE;
                 DECLARE v_akaun INT;
                 
                 -- Variables for fetching cursor data
                 DECLARE v_id BIGINT;
                 DECLARE v_mhn_idpbt VARCHAR(255);
                 DECLARE v_mhn_jenis VARCHAR(255);
                 DECLARE v_mhn_idpelanggan VARCHAR(255);
                 DECLARE v_mhn_namaperniagaan VARCHAR(255);
                 DECLARE v_mhn_almtniaga1 VARCHAR(255);
                 DECLARE v_mhn_almtniaga2 VARCHAR(255);
                 DECLARE v_mhn_norujukan VARCHAR(255);
                 DECLARE v_mhn_tkmohon DATE;
                 DECLARE v_mhn_tarikhlulus DATE;
                 DECLARE v_mhn_tkmula DATE;
                 DECLARE v_mhn_tktamat DATE;
                 DECLARE v_mhn_tempoh INT;
                 DECLARE v_mhn_notel VARCHAR(255);
                 DECLARE v_mhn_msmula VARCHAR(255);
                 DECLARE v_mhn_mstamat VARCHAR(255);
                 DECLARE v_mhn_kodlokasi VARCHAR(255);
                 DECLARE v_mhn_ptjpk VARCHAR(255);
                 DECLARE v_mhn_xcoordinat decimal(11,8);
                 DECLARE v_mhn_ycoordinat decimal(11,8);
                 DECLARE v_mhn_idate DATE;
                 DECLARE v_mhn_iuser VARCHAR(255);
                 DECLARE v_mhn_tkhmsyuarat DATE;
                 DECLARE v_lpk_melayu INT;
                 DECLARE v_lpk_cina INT;
                 DECLARE v_lpk_india INT;
                 DECLARE v_lpk_lainlain INT;

                 DECLARE cur1 CURSOR FOR
                     SELECT
                         a.id, a.mhn_idpbt, a.mhn_jenis,
                         a.mhn_idpelanggan, a.mhn_namaperniagaan,
                         a.mhn_almtniaga1, a.mhn_almtniaga2,
                         a.mhn_norujukan, a.mhn_tkmohon,
                         a.mhn_tarikhlulus, a.mhn_tkmula,
                         a.mhn_tktamat, a.mhn_tempoh, a.mhn_notel,
                         a.mhn_msmula, a.mhn_mstamat, a.mhn_kodlokasi,
                         a.mhn_ptjpk, a.mhn_xcoordinat, a.mhn_ycoordinat,
                         a.mhn_idate, a.mhn_iuser, a.mhn_tkhmsyuarat,
                         b.lpk_melayu, b.lpk_cina, b.lpk_india, b.lpk_lainlain
                     FROM osc_mhn_permohonan a
                     LEFT JOIN osc_mhn_lpekerja b ON a.mhn_idpbt = b.lpk_idpbt AND a.mhn_nosiri = b.lpk_nosiri
                     WHERE a.mhn_idpbt = p_idpbt
                       AND a.mhn_nosiri = p_nosiri;

                 DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

                 OPEN cur1;

                 read_loop: LOOP
                     FETCH cur1 INTO
                         v_id, v_mhn_idpbt, v_mhn_jenis,
                         v_mhn_idpelanggan, v_mhn_namaperniagaan,
                         v_mhn_almtniaga1, v_mhn_almtniaga2,
                         v_mhn_norujukan, v_mhn_tkmohon,
                         v_mhn_tarikhlulus, v_mhn_tkmula,
                         v_mhn_tktamat, v_mhn_tempoh, v_mhn_notel,
                         v_mhn_msmula, v_mhn_mstamat, v_mhn_kodlokasi,
                         v_mhn_ptjpk, v_mhn_xcoordinat, v_mhn_ycoordinat,
                         v_mhn_idate, v_mhn_iuser, v_mhn_tkhmsyuarat,
                         v_lpk_melayu, v_lpk_cina, v_lpk_india, v_lpk_lainlain;

                     IF done THEN
                         LEAVE read_loop;
                     END IF;

                     SELECT IFNULL(MAX(ind_akaun), 0) + 1 INTO v_akaun
                     FROM osc_ind_induklesen
                     WHERE ind_idpbt = p_idpbt;

                     INSERT INTO osc_ind_induklesen
                      (id, ind_idpbt, ind_akaun, ind_idpelanggan, ind_nosiri,
                       ind_jenisplg, ind_tkhmsyuarat, ind_ptjpk, ind_kodlokasi,
                       ind_namaperniagaan, ind_almtperniagaan1,
                       ind_almtperniagaan2, ind_norujukan, ind_tkhmohon,
                       ind_tkhlulus, ind_katniaga, ind_statl, ind_tkhmula,
                       ind_tkhtamat, ind_tempoh, ind_notelefon, ind_msmula,
                       ind_mstamat, ind_xcoordinat, ind_ycoordinat, ind_idate,
                       ind_udate, ind_iuser, ind_uuser)
                      VALUES
                     ( v_id, v_mhn_idpbt, v_akaun, v_mhn_idpelanggan, p_nosiri,
                       v_mhn_jenis, v_mhn_tkhmsyuarat, v_mhn_ptjpk, v_mhn_kodlokasi,
                       v_mhn_namaperniagaan, v_mhn_almtniaga1, v_mhn_almtniaga2,
                       v_mhn_norujukan, v_mhn_tkmohon,
                       v_mhn_tarikhlulus, '1', 'A', v_mhn_tkmula,
                       v_mhn_tktamat, v_mhn_tempoh, v_mhn_notel,
                       v_mhn_msmula, v_mhn_mstamat,
                       v_mhn_xcoordinat, v_mhn_ycoordinat, v_mhn_idate, NOW(),
                       v_mhn_iuser, p_uuser);

                     INSERT INTO osc_ind_lpekerja
                      (id, lpk_idpbt, lpk_akaun, lpk_melayu, lpk_cina,
                       lpk_india, lpk_lainlain, lpk_idate, lpk_udate,
                       lpk_iuser, lpk_uuser)
                     VALUES
                      ( p_id1, p_idpbt, v_akaun, v_lpk_melayu, v_lpk_cina,
                       v_lpk_india, v_lpk_lainlain,
                       v_mhn_idate, NOW(), v_mhn_iuser, p_uuser);

                     INSERT INTO osc_da_kemudahan
                       (id, kmdh_idpelanggan, kmdh_alamatid, kmdh_modakaun, kmdh_noakaun, kmdh_stathitam,
                        kmdh_idate, kmdh_udate, kmdh_iuser, kmdh_uuser)
                     VALUES
                       ( p_id1, v_mhn_idpelanggan, 10, 'L', v_akaun, 'T',
                        v_mhn_idate, NOW(), v_mhn_iuser, p_uuser);

                     CALL sp_ins_translesen(p_id1, p_idpbt, p_nosiri, v_akaun, p_uuser);
                     CALL sp_ins_iklanlesen(p_id1, p_idpbt, p_nosiri, v_akaun, p_uuser);
                     CALL sp_ins_nominilesen(p_id1, p_idpbt, p_nosiri, v_akaun, p_uuser);
                     CALL sp_ins_dokumenlesen(p_id1, p_idpbt, p_nosiri, v_akaun, p_uuser);
                     CALL sp_ins_gambarlesen(p_id1, p_idpbt, p_nosiri, v_akaun, p_uuser);

                 END LOOP;

                 CLOSE cur1;
             END;
        ");

        // ins_kodniaga_baru
        DB::unprepared("
            DROP PROCEDURE IF EXISTS ins_kodniaga_baru;
            CREATE PROCEDURE ins_kodniaga_baru()
            BEGIN
                UPDATE osc_kod_niaga t1
                JOIN (
                     SELECT
                        id,
                        CONCAT(nia_kodundang, nia_kodaktiviti, LPAD(ROW_NUMBER() OVER (PARTITION BY nia_kodundang, nia_kodaktiviti ORDER BY nia_kodundang, nia_kodaktiviti), 5, '0')) as new_code
                     FROM osc_kod_niaga
                ) t2 ON t1.id = t2.id
                SET t1.nia_kodniaga = t2.new_code;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_induklesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_nominilesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_translesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_iklanlesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_gambarlesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_ins_dokumenlesen");
        DB::unprepared("DROP PROCEDURE IF EXISTS ins_kodniaga_baru");
        DB::unprepared("DROP FUNCTION IF EXISTS get_no_akaun");
    }
};
