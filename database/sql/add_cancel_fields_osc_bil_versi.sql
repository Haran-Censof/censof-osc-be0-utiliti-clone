-- =====================================================
-- Migration: Tambah field pembatalan ke osc_bil_versi
-- UC-PL-BY-PL-04: Pembatalan / Re-issue Lesen
-- Tarikh: 2026-03-15
-- =====================================================

-- Tambah field untuk pembatalan sijil
ALTER TABLE osc_bil_versi 
ADD COLUMN bl3_sebab_batal VARCHAR(500) NULL COMMENT 'Sebab pembatalan sijil' AFTER bl3_status,
ADD COLUMN bl3_tarikh_batal DATE NULL COMMENT 'Tarikh pembatalan' AFTER bl3_sebab_batal,
ADD COLUMN bl3_user_batal VARCHAR(50) NULL COMMENT 'User yang membatalkan' AFTER bl3_tarikh_batal;

-- Index untuk query sijil yang dibatalkan
CREATE INDEX idx_bil_versi_status_batal ON osc_bil_versi (bl3_status, bl3_tarikh_batal);

-- =====================================================
-- Contoh penggunaan:
-- =====================================================
-- UPDATE osc_bil_versi 
-- SET bl3_status = 'C',
--     bl3_sebab_batal = 'Maklumat tidak tepat',
--     bl3_tarikh_batal = CURDATE(),
--     bl3_user_batal = 'ADMIN001'
-- WHERE bl3_idpbt = 'PRK_MDTM' AND bl3_noakaun = 900011;
