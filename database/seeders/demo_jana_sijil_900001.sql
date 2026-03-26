-- ============================================================
-- Demo Data untuk Skrin Jana Sijil Lesen
-- No Akaun: 900001 - 900005
-- IDPBT: PRK_MDTM
-- 
-- NOTA: bil_kdsrpbt = idpbt, bil_nombor = noakaun
-- ============================================================

-- ============================================================
-- STEP 1: Buat table osc_bil_versi (jika belum ada)
-- ============================================================

CREATE TABLE IF NOT EXISTS osc_bil_versi (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bl3_idpbt VARCHAR(10) NULL COMMENT 'KOD ID PBT',
    bl3_noakaun INT NULL COMMENT 'NO AKAUN LESEN',
    bl3_tarikh DATE NULL COMMENT 'TARIKH VERSI',
    bl3_nolesen VARCHAR(30) NULL COMMENT 'NO LESEN',
    bl3_sijil_path VARCHAR(255) NULL COMMENT 'PATH FAIL SIJIL',
    bl3_sijil_checksum VARCHAR(64) NULL COMMENT 'CHECKSUM SIJIL',
    bl3_qr_data TEXT NULL COMMENT 'DATA QR CODE',
    bl3_qr_path VARCHAR(255) NULL COMMENT 'PATH FAIL QR',
    bl3_qr_checksum VARCHAR(64) NULL COMMENT 'CHECKSUM QR',
    bl3_signature TEXT NULL COMMENT 'DIGITAL SIGNATURE',
    bl3_status VARCHAR(1) DEFAULT 'P' COMMENT 'STATUS (P=Pending, A=Active, X=Expired)',
    bl3_idate DATE NULL COMMENT 'TARIKH INPUT',
    bl3_udate DATE NULL COMMENT 'TARIKH KEMASKINI',
    bl3_iuser VARCHAR(20) NULL COMMENT 'USER INPUT',
    bl3_uuser VARCHAR(20) NULL COMMENT 'USER KEMASKINI',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX idx_bil_versi_pbt_akaun (bl3_idpbt, bl3_noakaun),
    INDEX idx_bil_versi_checksum (bl3_sijil_checksum),
    INDEX idx_bil_versi_status (bl3_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='VERSI SIJIL LESEN';

-- ============================================================
-- STEP 2: Insert Data Pelanggan
-- ============================================================

INSERT INTO osc_da_pelanggan (
    plgn_idpbt, plgn_idpelanggan, plgn_pelanggannama, plgn_pelangganjenis,
    plgn_tinid, plgn_idate, plgn_udate, plgn_iuser, plgn_uuser, created_at, updated_at
) VALUES 
('PRK_MDTM', 'PLG900001', 'AHMAD BIN ABDULLAH', 'I', '850101145678', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 'PLG900002', 'SITI BINTI HASSAN', 'I', '880515147890', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 'PLG900003', 'MOHD RAZAK BIN ISMAIL', 'I', '790820145432', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 'PLG900004', 'NUR AISYAH BINTI KAMAL', 'I', '920315146789', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 'PLG900005', 'TAN AH KOW', 'I', '750612145678', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW())
ON DUPLICATE KEY UPDATE plgn_pelanggannama = VALUES(plgn_pelanggannama);


-- ============================================================
-- STEP 3: Insert Data Induk Lesen
-- ============================================================

INSERT INTO osc_ind_induklesen (
    ind_idpbt, ind_akaun, ind_idpelanggan, ind_namaperniagaan, ind_almtperniagaan1, ind_almtperniagaan2, ind_poskod,
    ind_kodlokasi, ind_statl, ind_tempoh, ind_tkhmula, ind_tkhtamat,
    ind_idate, ind_udate, ind_iuser, ind_uuser, created_at, updated_at
) VALUES 
('PRK_MDTM', 900011, 'PLG900001', 'RESTORAN AHMAD JAYA', 'No. 45, Jalan Perniagaan', 'Pusat Komersial Maju', '75100', 1, 'A', 12, '2026-01-01', '2026-12-31', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900012, 'PLG900002', 'KEDAI RUNCIT SITI', 'No. 12, Jalan Harmoni', 'Taman Sejahtera', '75200', 1, 'A', 12, '2026-01-01', '2026-12-31', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900013, 'PLG900003', 'BENGKEL KERETA RAZAK', 'Lot 23, Kawasan Perindustrian', 'Melaka Tengah', '75300', 2, 'A', 12, '2026-01-01', '2026-12-31', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900014, 'PLG900004', 'BUTIK AISYAH COLLECTION', 'No. 8, Plaza Sentral', 'Bandar Melaka', '75400', 1, 'A', 12, '2026-01-01', '2026-12-31', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900015, 'PLG900005', 'KEDAI KOPI TAN', 'No. 1, Jalan Hang Tuah', 'Melaka Raya', '75500', 1, 'A', 12, '2026-01-01', '2026-12-31', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW())
ON DUPLICATE KEY UPDATE ind_namaperniagaan = VALUES(ind_namaperniagaan);

-- ============================================================
-- STEP 4: Insert Data Bil Bayaran (Status PAID - Layak Jana Sijil)
-- bil_kdsrpbt = idpbt, bil_nombor = noakaun
-- ============================================================

INSERT INTO osc_bil_bayaran (
    bil_kdsrpbt, bil_nombor, bil_idpermohonan, bil_jenis, 
    bil_yuranasas, bil_larasansaiz, bil_dendalewat, bil_jumlah, bil_status,
    bil_tarikhjanaan, bil_tarikhtempoh, bil_keterangan,
    bil_tarikhcipta, bil_ciptaoleh, bil_tarikhmaskini, bil_maskiniole, created_at, updated_at
) VALUES 
('PRK_MDTM', '900011', 1, 'APPLICATION', 500.00, 0.00, 0.00, 500.00, 'PAID', CURDATE(), '2026-03-31', 'Bayaran Lesen Perniagaan Tahun 2026', NOW(), 'SYSTEM', NOW(), 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', '900012', 2, 'APPLICATION', 300.00, 0.00, 0.00, 300.00, 'PAID', CURDATE(), '2026-03-31', 'Bayaran Lesen Perniagaan', NOW(), 'SYSTEM', NOW(), 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', '900013', 3, 'APPLICATION', 450.00, 0.00, 0.00, 450.00, 'PAID', CURDATE(), '2026-03-31', 'Bayaran Lesen Perniagaan', NOW(), 'SYSTEM', NOW(), 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', '900014', 4, 'APPLICATION', 350.00, 0.00, 0.00, 350.00, 'PAID', CURDATE(), '2026-03-31', 'Bayaran Lesen Perniagaan', NOW(), 'SYSTEM', NOW(), 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', '900015', 5, 'APPLICATION', 400.00, 0.00, 0.00, 400.00, 'PAID', CURDATE(), '2026-03-31', 'Bayaran Lesen Perniagaan', NOW(), 'SYSTEM', NOW(), 'SYSTEM', NOW(), NOW())
ON DUPLICATE KEY UPDATE bil_status = VALUES(bil_status), bil_tarikhjanaan = CURDATE();

-- ============================================================
-- STEP 5: Insert Data Transaksi Lesen (osc_ind_translesen)
-- ============================================================

INSERT INTO osc_ind_translesen (
    trn_idpbt, trn_akaun, trn_sequtama, trn_kodniaga, trn_kodniaga1, trn_kodniaga2, trn_kodniaga3,
    trn_tmbhkurng, trn_statcagar, trn_stattrans, trn_idate, trn_udate, trn_iuser, trn_uuser, created_at, updated_at
) VALUES 
-- Akaun 900001 (Restoran - 2 kod niaga)
('PRK_MDTM', 900011, 1, '5610100', '56', '101', '00', 0.00, 'T', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900011, 2, '5610200', '56', '102', '00', 50.00, 'T', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900002 (Kedai Runcit)
('PRK_MDTM', 900012, 1, '4711100', '47', '111', '00', 0.00, 'T', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900003 (Bengkel Kereta)
('PRK_MDTM', 900013, 1, '4520100', '45', '201', '00', 0.00, 'Y', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900004 (Butik)
('PRK_MDTM', 900014, 1, '4771000', '47', '710', '00', 0.00, 'T', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900005 (Kedai Kopi)
('PRK_MDTM', 900015, 1, '5630100', '56', '301', '00', 0.00, 'T', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW())
ON DUPLICATE KEY UPDATE trn_stattrans = VALUES(trn_stattrans);


-- ============================================================
-- STEP 6: Insert Data Iklan Lesen (osc_ind_iklanlesen)
-- ============================================================

INSERT INTO osc_ind_iklanlesen (
    lan_idpbt, lan_akaun, lan_rujukan, lan_tkhmula, lan_tkhtmt, lan_amaun,
    lan_lentang, lan_berlampu, lan_stataktif, lan_panjang, lan_lebar,
    lan_tempat, lan_keterangan, lan_statf, lan_idate, lan_udate, lan_iuser, lan_uuser, created_at, updated_at
) VALUES 
-- Akaun 900001 (Restoran - 2 papan tanda)
('PRK_MDTM', 900011, 'IKL/2026/000001', '2026-01-01', '2026-12-31', 120.00, 'Y', 'Y', 'A', 3.00, 1.50, 'Hadapan Kedai', 'Papan Tanda Restoran Ahmad Jaya', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
('PRK_MDTM', 900011, 'IKL/2026/000002', '2026-01-01', '2026-12-31', 80.00, 'T', 'T', 'A', 2.00, 1.00, 'Tepi Jalan', 'Banner Promosi', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900002 (Kedai Runcit)
('PRK_MDTM', 900012, 'IKL/2026/000003', '2026-01-01', '2026-12-31', 100.00, 'Y', 'T', 'A', 2.50, 1.20, 'Atas Pintu', 'Papan Nama Kedai', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900003 (Bengkel)
('PRK_MDTM', 900013, 'IKL/2026/000004', '2026-01-01', '2026-12-31', 200.00, 'Y', 'Y', 'A', 5.00, 2.00, 'Bumbung Bengkel', 'Papan Tanda Bengkel Razak', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900004 (Butik)
('PRK_MDTM', 900014, 'IKL/2026/000005', '2026-01-01', '2026-12-31', 150.00, 'T', 'Y', 'A', 2.00, 3.00, 'Tingkap Depan', 'Neon Sign Butik Aisyah', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW()),
-- Akaun 900005 (Kedai Kopi)
('PRK_MDTM', 900015, 'IKL/2026/000006', '2026-01-01', '2026-12-31', 90.00, 'Y', 'T', 'A', 2.00, 1.00, 'Depan Kedai', 'Papan Tanda Kedai Kopi Tan', 'A', NOW(), NOW(), 'SYSTEM', 'SYSTEM', NOW(), NOW())
ON DUPLICATE KEY UPDATE lan_stataktif = VALUES(lan_stataktif);

-- ============================================================
-- Verify Data
-- ============================================================
-- SELECT * FROM osc_ind_induklesen WHERE ind_idpbt = 'PRK_MDTM' AND ind_akaun IN (900001, 900002, 900003, 900004, 900005);
-- SELECT * FROM osc_bil_bayaran WHERE bil_kdsrpbt = 'PRK_MDTM' AND bil_nombor IN ('900001', '900002', '900003', '900004', '900005');
-- SELECT * FROM osc_da_pelanggan WHERE plgn_idpelanggan LIKE 'PLG9000%';
-- SELECT * FROM osc_ind_translesen WHERE trn_idpbt = 'PRK_MDTM' AND trn_akaun IN (900001, 900002, 900003, 900004, 900005);
-- SELECT * FROM osc_ind_iklanlesen WHERE lan_idpbt = 'PRK_MDTM' AND lan_akaun IN (900001, 900002, 900003, 900004, 900005);
