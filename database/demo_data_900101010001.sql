-- ============================================================
-- Demo Data untuk idpelanggan: 900101010001
-- PBT: PRK_MDTM
-- No Akaun: 900001
-- DB: osc_pelesenan @ 154.26.137.114:30306
-- ============================================================

SET @idpelanggan = '900101010001';
SET @pbtCode = 'PRK_MDTM';
SET @noAkaun = 900001;
SET @namaPelanggan = 'AHMAD BIN DEMO';
SET @namaPerniagaan = 'KEDAI RUNCIT DEMO AHMAD';
SET @nosiri = CONCAT(@pbtCode, DATE_FORMAT(NOW(), '%y%m'), '9001');
SET @now = NOW();
SET @tkhMohon = DATE_SUB(@now, INTERVAL 30 DAY);
SET @tkhLulus = DATE_SUB(@now, INTERVAL 15 DAY);
SET @tkhMula = DATE_SUB(@now, INTERVAL 10 DAY);
SET @tkhTamat = DATE_ADD(@now, INTERVAL 1 YEAR);
SET @noBil = CONCAT('BIL', DATE_FORMAT(@now, '%Y%m%d'), '0001');

-- ============================================================
-- 1. PELANGGAN (osc_da_pelanggan)
-- ============================================================
INSERT INTO osc_da_pelanggan (
    plgn_idpbt, plgn_idpelanggan, plgn_pelanggannama, plgn_pelangganjenis,
    plgn_idate, plgn_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @idpelanggan, @namaPelanggan, 'I',
    @now, 'DEMO_SQL', @now, @now
) ON DUPLICATE KEY UPDATE
    plgn_pelanggannama = @namaPelanggan,
    plgn_udate = @now,
    plgn_uuser = 'DEMO_SQL',
    updated_at = @now;

-- ============================================================
-- 2. ALAMAT PELANGGAN (osc_da_alamat)
-- ============================================================
INSERT INTO osc_da_alamat (
    almt_idpbt, almt_idpelanggan, almt_alamatid,
    almt_alamat01, almt_alamat02, almt_alamat03, almt_poskod,
    almt_notelefon, almt_nomborhp, almt_email,
    almt_idate, almt_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @idpelanggan, 1,
    'NO. 123, JALAN DEMO', 'TAMAN DEMO INDAH', 'TAIPING', '34000',
    '0123456789', '0123456789', 'demo@example.com',
    @now, 'DEMO_SQL', @now, @now
) ON DUPLICATE KEY UPDATE
    almt_alamat01 = 'NO. 123, JALAN DEMO',
    almt_udate = @now,
    almt_uuser = 'DEMO_SQL',
    updated_at = @now;

-- ============================================================
-- 3. PERMOHONAN (osc_mhn_permohonan)
-- ============================================================
DELETE FROM osc_mhn_permohonan 
WHERE mhn_idpelanggan = @idpelanggan AND mhn_noakaun = @noAkaun;

INSERT INTO osc_mhn_permohonan (
    mhn_idpbt, mhn_jenismhn, mhn_jenis, mhn_idpelanggan, mhn_nama,
    mhn_alamatpos1, mhn_alamatpos2, mhn_alamatpos3, mhn_alamatpos4, mhn_poskod,
    mhn_emel, mhn_nomhp, mhn_notel, mhn_kodlokasi,
    mhn_namaperniagaan, mhn_almtniaga1, mhn_almtniaga2, mhn_almtniaga3, mhn_almtniaga4, mhn_poskod2,
    mhn_tkmohon, mhn_tarikhlulus, mhn_statl, mhn_tkmula, mhn_tktamat, mhn_tempoh,
    mhn_msmula, mhn_mstamat, mhn_jenisplg, mhn_nosiri, mhn_norujukan, mhn_noakaun, mhn_ptjpk,
    mhn_idate, mhn_iuser, created_at, updated_at
) VALUES (
    @pbtCode, 'B', '1', @idpelanggan, @namaPelanggan,
    'NO. 123, JALAN DEMO', 'TAMAN DEMO INDAH', '34000 TAIPING', 'PERAK', '34000',
    'demo@example.com', '0123456789', '0123456789', 1,
    @namaPerniagaan, 'NO. 456, JALAN PERNIAGAAN', 'PUSAT PERNIAGAAN DEMO', '34000 TAIPING', 'PERAK', '34000',
    @tkhMohon, @tkhLulus, 'L', @tkhMula, @tkhTamat, 12,
    '08:00', '22:00', 'I', @nosiri, CONCAT('DEMO/', YEAR(@now), '/0001'), @noAkaun, '01',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- 4. TRANSAKSI PERMOHONAN (osc_mhn_transaksi)
-- ============================================================
DELETE FROM osc_mhn_transaksi WHERE trn_nosiri = @nosiri;

INSERT INTO osc_mhn_transaksi (
    trn_idpbt, trn_nosiri, trn_akaun, trn_utama,
    trn_kodp1, trn_kodp2, trn_kodp3,
    trn_tmbhkurng, trn_scagr, trn_statt,
    trn_idate, trn_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @nosiri, @noAkaun, 1,
    '01', '001', '01',
    0.00, 'T', 'A',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- 5. INDUK LESEN (osc_ind_induklesen)
-- ============================================================
DELETE FROM osc_ind_induklesen 
WHERE ind_idpelanggan = @idpelanggan AND ind_akaun = @noAkaun;

INSERT INTO osc_ind_induklesen (
    ind_idpbt, ind_akaun, ind_idpelanggan, ind_nosiri, ind_jenisplg,
    ind_tkhmsyuarat, ind_ptjpk, ind_kodlokasi,
    ind_namaperniagaan, ind_almtperniagaan, ind_norujukan,
    ind_tkhmohon, ind_tkhlulus, ind_katniaga, ind_statl,
    ind_tkhmula, ind_tkhtamat, ind_tempoh,
    ind_notelefon, ind_msmula, ind_mstamat,
    ind_idate, ind_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @noAkaun, @idpelanggan, @nosiri, 'I',
    @tkhLulus, '01', 1,
    @namaPerniagaan, 'NO. 456, JALAN PERNIAGAAN, PUSAT PERNIAGAAN DEMO, 34000 TAIPING, PERAK', CONCAT('DEMO/', YEAR(@now), '/0001'),
    @tkhMohon, @tkhLulus, 1, 'A',
    @tkhMula, @tkhTamat, 12,
    '0123456789', '08:00', '22:00',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- 6. TRANSAKSI LESEN (osc_ind_translesen)
-- trn_kodniaga is NOT NULL, need valid value
-- ============================================================
DELETE FROM osc_ind_translesen 
WHERE trn_idpbt = @pbtCode AND trn_akaun = @noAkaun;

INSERT INTO osc_ind_translesen (
    trn_idpbt, trn_akaun, trn_sequtama,
    trn_kodniaga, trn_kodniaga1, trn_kodniaga2, trn_kodniaga3,
    trn_tmbhkurng, trn_statcagar, trn_stattrans,
    trn_idate, trn_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @noAkaun, 1,
    '050010010001', '01', '001', '01',
    0.00, 'T', 'A',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- 7. BIL TEMPOH LESEN (osc_bil_tmphlesen)
-- ============================================================
DELETE FROM osc_bil_tmphlesen 
WHERE bl1_idpbt = @pbtCode AND bl1_noakaun = @noAkaun;

INSERT INTO osc_bil_tmphlesen (
    bl1_idpbt, bl1_noakaun, bl1_nombil, bl1_tkhbil, bl1_tempoh, bl1_statf,
    bl1_idate, bl1_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @noAkaun, @noBil, DATE_SUB(@now, INTERVAL 10 DAY), @tkhTamat, 'N',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- 8. TRANSAKSI BIL LESEN (osc_bil_translesen)
-- ============================================================
DELETE FROM osc_bil_translesen 
WHERE bl2_idpbt = @pbtCode AND bl2_noakaun = @noAkaun;

-- Yuran Lesen
INSERT INTO osc_bil_translesen (
    bl2_idpbt, bl2_noakaun, bl2_transaksi, bl2_nombil, bl2_amaun, bl2_statf,
    bl2_idate, bl2_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @noAkaun, '21001', @noBil, 150.00, 'N',
    @now, 'DEMO_SQL', @now, @now
);

-- Duti Setem
INSERT INTO osc_bil_translesen (
    bl2_idpbt, bl2_noakaun, bl2_transaksi, bl2_nombil, bl2_amaun, bl2_statf,
    bl2_idate, bl2_iuser, created_at, updated_at
) VALUES (
    @pbtCode, @noAkaun, '21002', @noBil, 10.00, 'N',
    @now, 'DEMO_SQL', @now, @now
);

-- ============================================================
-- VERIFICATION
-- ============================================================
SELECT 'PELANGGAN' AS tbl, plgn_idpelanggan, plgn_pelanggannama FROM osc_da_pelanggan WHERE plgn_idpelanggan = @idpelanggan;
SELECT 'PERMOHONAN' AS tbl, mhn_nosiri, mhn_namaperniagaan, mhn_statl, mhn_noakaun FROM osc_mhn_permohonan WHERE mhn_idpelanggan = @idpelanggan;
SELECT 'MHN_TRANS' AS tbl, trn_nosiri, trn_kodp1, trn_kodp2, trn_kodp3 FROM osc_mhn_transaksi WHERE trn_nosiri = @nosiri;
SELECT 'INDUKLESEN' AS tbl, ind_akaun, ind_namaperniagaan, ind_statl FROM osc_ind_induklesen WHERE ind_idpelanggan = @idpelanggan;
SELECT 'IND_TRANS' AS tbl, trn_akaun, trn_kodniaga, trn_stattrans FROM osc_ind_translesen WHERE trn_akaun = @noAkaun;
SELECT 'BIL_TMPH' AS tbl, bl1_noakaun, bl1_nombil FROM osc_bil_tmphlesen WHERE bl1_noakaun = @noAkaun;
SELECT 'BIL_TRANS' AS tbl, bl2_noakaun, bl2_transaksi, bl2_amaun FROM osc_bil_translesen WHERE bl2_noakaun = @noAkaun;
