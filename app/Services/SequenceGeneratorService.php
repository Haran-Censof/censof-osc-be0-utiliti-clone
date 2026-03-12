<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

/**
 * Centralized Sequence Generator Service
 *
 * Generates unique running numbers for applications, bills, licenses, and meetings
 * with atomic increments using Redis to prevent race conditions.
 *
 * Format: {PBT_CODE}/{TYPE}/{YEAR}/{SEQUENCE}
 * Example: MBSJ/APP/2025/000000000001
 */
class SequenceGeneratorService
{
    /**
     * Generate next application reference number
     *
     * Format: MBSJ/APP/2025/000000000001
     * Capacity: 999,999,999,999 per year per PBT (999 billion)
     *
     * @param string $pbtCode PBT code (e.g., 'MBSJ', 'MBPJ')
     * @return string Application reference number
     */
    public function generateApplicationRef(string $pbtCode): string
    {
        $year = now()->format('Y');
        $key = "app_seq:{$pbtCode}:{$year}";

        // Use Redis atomic increment
        $sequence = Cache::increment($key);

        // Reset counter on January 1st if needed
        if ($sequence == 1) {
            Cache::put($key, 1, now()->endOfYear());
        }

        return sprintf('%s/APP/%s/%012d', $pbtCode, $year, $sequence);
    }

    /**
     * Generate next bill number
     *
     * Format: MBSJ/BIL/2025/000000000001
     * Capacity: 999,999,999,999 per year per PBT (999 billion)
     *
     * @param string $pbtCode PBT code
     * @return string Bill number
     */
    public function generateBillNumber(string $pbtCode): string
    {
        $year = now()->format('Y');
        $key = "bill_seq:{$pbtCode}:{$year}";

        // Use Redis atomic increment
        $sequence = Cache::increment($key);

        // Reset counter on January 1st if needed
        if ($sequence == 1) {
            Cache::put($key, 1, now()->endOfYear());
        }

        return sprintf('%s/BIL/%s/%012d', $pbtCode, $year, $sequence);
    }

    /**
     * Generate next license number
     *
     * Format: MBSJ/FOOD/2025/000000000001
     * Capacity: 999,999,999,999 per year per PBT per license type (999 billion)
     *
     * @param string $pbtCode PBT code
     * @param string $licenseTypeCode License type code (e.g., 'FOOD', 'TRADE')
     * @return string License number
     */
    public function generateLicenseNumber(string $pbtCode, string $licenseTypeCode): string
    {
        $year = now()->format('Y');
        $key = "lic_seq:{$pbtCode}:{$licenseTypeCode}:{$year}";

        // Use Redis atomic increment
        $sequence = Cache::increment($key);

        // Reset counter on January 1st if needed
        if ($sequence == 1) {
            Cache::put($key, 1, now()->endOfYear());
        }

        return sprintf('%s/%s/%s/%012d', $pbtCode, $licenseTypeCode, $year, $sequence);
    }

    /**
     * Generate next meeting number
     *
     * Format: MBSJ/MSY/2025/0000000001
     * Capacity: 9,999,999,999 per year per PBT (10 billion)
     *
     * @param string $pbtCode PBT code
     * @return string Meeting number
     */
    public function generateMeetingNumber(string $pbtCode): string
    {
        $year = now()->format('Y');
        $key = "meeting_seq:{$pbtCode}:{$year}";

        // Use Redis atomic increment
        $sequence = Cache::increment($key);

        // Reset counter on January 1st if needed
        if ($sequence == 1) {
            Cache::put($key, 1, now()->endOfYear());
        }

        return sprintf('%s/MSY/%s/%010d', $pbtCode, $year, $sequence);
    }

    /**
     * Generate next complaint reference number
     *
     * Format: MBSJ/ADN/26/0001
     * Constraint: max 16 chars (adn_noaduan varchar(16))
     * Capacity: 9,999 per year per PBT
     *
     * @param string $pbtCode PBT code (e.g., 'MBSJ', 'MBPJ')
     * @return string Complaint reference number
     */
    public function generateComplaintRef(string $pbtCode): string
    {
        $year = now()->format('y');
        $key = "adn_seq:{$pbtCode}:{$year}";

        $sequence = Cache::increment($key);

        if ($sequence == 1) {
            Cache::put($key, 1, now()->endOfYear());
        }

        return sprintf('%s/ADN/%s/%04d', $pbtCode, $year, $sequence);
    }

}
