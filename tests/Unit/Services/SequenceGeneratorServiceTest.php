<?php

namespace Tests\Unit\Services;

use App\Services\SequenceGeneratorService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SequenceGeneratorServiceTest extends TestCase
{
    use DatabaseTransactions;

    private SequenceGeneratorService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SequenceGeneratorService();

        // Clear Redis cache to reset sequences between tests
        \Illuminate\Support\Facades\Cache::flush();
    }

    public function test_generates_application_reference_with_correct_format()
    {
        $refNo = $this->service->generateApplicationRef('MBSJ');
        
        $this->assertMatchesRegularExpression('/^MBSJ\/APP\/\d{4}\/\d{12}$/', $refNo);
        $this->assertStringContainsString('/APP/' . now()->year . '/', $refNo);
    }

    public function test_generates_bill_number_with_correct_format()
    {
        $billNo = $this->service->generateBillNumber('MBPJ');
        
        $this->assertMatchesRegularExpression('/^MBPJ\/BIL\/\d{4}\/\d{12}$/', $billNo);
        $this->assertStringContainsString('/BIL/' . now()->year . '/', $billNo);
    }

    public function test_generates_license_number_with_correct_format()
    {
        $licenseNo = $this->service->generateLicenseNumber('MBSJ', 'FOOD');
        
        $this->assertMatchesRegularExpression('/^MBSJ\/FOOD\/\d{4}\/\d{12}$/', $licenseNo);
        $this->assertStringContainsString('/FOOD/' . now()->year . '/', $licenseNo);
    }

    public function test_generates_meeting_number_with_correct_format()
    {
        $meetingNo = $this->service->generateMeetingNumber('MBPJ');
        
        $this->assertMatchesRegularExpression('/^MBPJ\/MSY\/\d{4}\/\d{10}$/', $meetingNo);
        $this->assertStringContainsString('/MSY/' . now()->year . '/', $meetingNo);
    }

    public function test_sequences_increment_correctly()
    {
        // Generate first sequence
        $refNo1 = $this->service->generateApplicationRef('MBSJ');
        $this->assertStringEndsWith('000000000001', $refNo1);

        // Generate second sequence - should increment
        $refNo2 = $this->service->generateApplicationRef('MBSJ');
        $this->assertStringEndsWith('000000000002', $refNo2);
        
        // Verify they're different
        $this->assertNotEquals($refNo1, $refNo2);
    }

    public function test_pbt_isolation()
    {
        // MBSJ has sequence 1
        $refNo1 = $this->service->generateApplicationRef('MBSJ');
        $this->assertStringContainsString('MBSJ/APP', $refNo1);
        $this->assertStringEndsWith('000000000001', $refNo1);

        // MBPJ should also start at 1 (isolated)
        $refNo2 = $this->service->generateApplicationRef('MBPJ');
        $this->assertStringContainsString('MBPJ/APP', $refNo2);
        $this->assertStringEndsWith('000000000001', $refNo2);
    }
}
