<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\InternalUser;
use App\Models\License;
use App\Models\LicenseType;
use App\Models\Meeting;
use App\Models\MeetingAgenda;
use App\Models\MeetingAgendaItem;
use App\Models\MeetingAttendee;
use App\Models\MeetingDecision;
use App\Models\MeetingMinute;
use App\Models\Officer;
use App\Models\Pbt;
use App\Models\Query;
use App\Models\Recommendation;
use App\Models\Renewal;
use App\Models\Review;
use App\Models\SiteVisit;
use App\Models\StatusHistory;
use App\Models\TechnicalReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds for demonstration.
     */
    public function run(): void
    {
        // Create demo users
        $this->createDemoUsers();

        // Create comprehensive PBT data
        $this->createDemoPBTs();

        // Create comprehensive license types
        $this->createDemoLicenseTypes();

        // Create document types
        $this->createDocumentTypes();

        // Create demo customers with realistic data
        $this->createDemoCustomers();

        // Create internal users and officers
        $this->createDemoInternalUsers();

        // Create comprehensive application scenarios
        $this->createDemoApplications();

        // Create complete review workflows
        $this->createDemoReviews();

        // Create billing scenarios
        $this->createDemoBills();

        // Create licenses
        $this->createDemoLicenses();

        // Create meeting scenarios
        $this->createDemoMeetings();

        // Create renewal scenarios
        $this->createDemoRenewals();

        // Create status history for audit trails
        $this->createStatusHistory();
    }

    private function createDemoUsers(): void
    {
        // Create demo customer users
        $customers = [
            ['name' => 'Ahmad bin Abdullah', 'email' => 'ahmad.restaurant@example.com'],
            ['name' => 'Siti Aminah', 'email' => 'siti.retail@example.com'],
            ['name' => 'Raj Kumar', 'email' => 'raj.services@example.com'],
            ['name' => 'Fatimah Hassan', 'email' => 'fatimah.food@example.com'],
            ['name' => 'Mohd Zain', 'email' => 'mohd.construction@example.com'],
        ];

        foreach ($customers as $customer) {
            User::factory()->create([
                'user_name' => $customer['name'],
                'user_email' => $customer['email'],
                'user_password' => Hash::make('demo123'),
                'user_group' => '01', // External user
            ]);
        }

        // Create demo officer users
        $officers = [
            ['name' => 'Encik Rahman (Screening Officer)', 'email' => 'rahman.officer@example.com'],
            ['name' => 'Puan Lisa (Technical Reviewer)', 'email' => 'lisa.reviewer@example.com'],
            ['name' => 'Tuan Hassan (Approver)', 'email' => 'hassan.approver@example.com'],
        ];

        foreach ($officers as $officer) {
            User::factory()->create([
                'user_name' => $officer['name'],
                'user_email' => $officer['email'],
                'user_password' => Hash::make('demo123'),
                'user_group' => '02', // Internal user
            ]);
        }
    }

    private function createDemoPBTs(): void
    {
        $pbts = [
            ['maj_kdsrpbt' => 'KL', 'maj_namapbt' => 'Dewan Bandaraya Kuala Lumpur'],
            ['maj_kdsrpbt' => 'SEL', 'maj_namapbt' => 'Majlis Bandaraya Shah Alam'],
            ['maj_kdsrpbt' => 'PJ', 'maj_namapbt' => 'Majlis Bandaraya Petaling Jaya'],
            ['maj_kdsrpbt' => 'SUB', 'maj_namapbt' => 'Majlis Perbandaran Subang Jaya'],
            ['maj_kdsrpbt' => 'KEL', 'maj_namapbt' => 'Majlis Perbandaran Klang'],
            ['maj_kdsrpbt' => 'SHAH', 'maj_namapbt' => 'Majlis Perbandaran Shah Alam'],
            ['maj_kdsrpbt' => 'AMP', 'maj_namapbt' => 'Majlis Perbandaran Ampang Jaya'],
        ];

        foreach ($pbts as $pbt) {
            Pbt::factory()->create($pbt);
        }
    }

    private function createDemoLicenseTypes(): void
    {
        $licenseTypes = [
            [
                'code' => 'REST',
                'name' => 'Restaurant License',
                'category' => 'FOOD',
                'pbt_code' => 'KL',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 500.00],
            ],
            [
                'code' => 'REST_EXP',
                'name' => 'Restaurant Express License',
                'category' => 'FOOD',
                'pbt_code' => 'KL',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 750.00],
            ],
            [
                'code' => 'FOOD_STALL',
                'name' => 'Food Stall License',
                'category' => 'FOOD',
                'pbt_code' => 'SEL',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 150.00],
            ],
            [
                'code' => 'CAFE',
                'name' => 'Café License',
                'category' => 'FOOD',
                'pbt_code' => 'PJ',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 300.00],
            ],
            [
                'code' => 'BAKERY',
                'name' => 'Bakery License',
                'category' => 'FOOD',
                'pbt_code' => 'SUB',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 250.00],
            ],
            [
                'code' => 'SUPERMARKET',
                'name' => 'Supermarket License',
                'category' => 'TRADE',
                'pbt_code' => 'SHAH',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 1000.00],
            ],
            [
                'code' => 'MINI_MARKET',
                'name' => 'Mini Market License',
                'category' => 'TRADE',
                'pbt_code' => 'AMP',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 400.00],
            ],
            [
                'code' => 'SERVICE',
                'name' => 'Service Business License',
                'category' => 'TRADE',
                'pbt_code' => 'KEL',
                'is_active' => true,
                'fee_structure' => ['base_fee' => 350.00],
            ],
        ];

        foreach ($licenseTypes as $type) {
            LicenseType::factory()->create($type);
        }
    }

    private function createDocumentTypes(): void
    {
        $documentTypes = [
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'SSMC', 'osc_docdesc' => 'SSM Registration Certificate', 'osc_catatan' => 'Official company registration certificate', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'ICOW', 'osc_docdesc' => 'Owner IC Copy', 'osc_catatan' => 'Photocopy of owner/manager identity card', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'ICPT', 'osc_docdesc' => 'Partner IC Copy', 'osc_catatan' => 'Photocopy of business partner identity cards', 'osc_statusd' => 'P'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'PREM', 'osc_docdesc' => 'Premise Layout Plan', 'osc_catatan' => 'Detailed floor plan of business premises', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'H', 'osc_kddocmt' => 'HLTH', 'osc_docdesc' => 'Food Handler Health Certificate', 'osc_catatan' => 'Medical certificate for food handlers', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'T', 'osc_kddocmt' => 'FIRE', 'osc_docdesc' => 'Fire Safety Certificate', 'osc_catatan' => 'Fire department safety compliance certificate', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'TENY', 'osc_docdesc' => 'Tenancy Agreement', 'osc_catatan' => 'Lease agreement for business premises', 'osc_statusd' => 'M'],
            ['osc_kdsrpbt' => '01', 'osc_ktegori' => 'B', 'osc_kddocmt' => 'BUSP', 'osc_docdesc' => 'Business Plan', 'osc_catatan' => 'Detailed business operation plan', 'osc_statusd' => 'P'],
        ];

        foreach ($documentTypes as $type) {
            DocumentType::factory()->create($type);
        }
    }

    private function createDemoCustomers(): void
    {
        $customers = [
            [
                'pp_plg_pelangganid' => 'CUST001',
                'pp_plg_pelanggannama' => 'Ahmad bin Abdullah',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => '123456789012',
                'pp_plg_sstid' => 'SST123456789',
                'pp_plg_catat' => 'Restaurant owner',
            ],
            [
                'pp_plg_pelangganid' => 'CUST002',
                'pp_plg_pelanggannama' => 'Siti Aminah Binti Hassan',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => '234567890123',
                'pp_plg_sstid' => 'SST234567890',
                'pp_plg_catat' => 'Retail business owner',
            ],
            [
                'pp_plg_pelangganid' => 'CUST003',
                'pp_plg_pelanggannama' => 'Raj Kumar A/L Suppiah',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => '345678901234',
                'pp_plg_sstid' => 'SST345678901',
                'pp_plg_catat' => 'Service business owner',
            ],
            [
                'pp_plg_pelangganid' => 'CUST004',
                'pp_plg_pelanggannama' => 'Fatimah Binti Mohd',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => '456789012345',
                'pp_plg_sstid' => 'SST456789012',
                'pp_plg_catat' => 'Food stall owner',
            ],
            [
                'pp_plg_pelangganid' => 'CUST005',
                'pp_plg_pelanggannama' => 'Mohd Zain bin Ismail',
                'pp_plg_pelangganjenis' => 'I',
                'pp_plg_tinid' => '567890123456',
                'pp_plg_sstid' => 'SST567890123',
                'pp_plg_catat' => 'Construction business owner',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::factory()->create($customer);
        }
    }

    private function createDemoInternalUsers(): void
    {
        $internalUsers = [
            [
                'user_id' => 'OFF001',
                'user_group_id' => '02',
                'user_name' => 'Encik Abdul Rahman',
                'user_password' => Hash::make('demo123'),
                'user_status' => 'A',
                'user_created' => now(),
                'user_pelangganid' => null,
                'user_iuser' => 'SYSTEM',
                'user_uuser' => 'SYSTEM',
            ],
            [
                'user_id' => 'OFF002',
                'user_group_id' => '02',
                'user_name' => 'Puan Lisa Tan',
                'user_password' => Hash::make('demo123'),
                'user_status' => 'A',
                'user_created' => now(),
                'user_pelangganid' => null,
                'user_iuser' => 'SYSTEM',
                'user_uuser' => 'SYSTEM',
            ],
            [
                'user_id' => 'OFF003',
                'user_group_id' => '02',
                'user_name' => 'Tuan Hassan bin Omar',
                'user_password' => Hash::make('demo123'),
                'user_status' => 'A',
                'user_created' => now(),
                'user_pelangganid' => null,
                'user_iuser' => 'SYSTEM',
                'user_uuser' => 'SYSTEM',
            ],
        ];

        foreach ($internalUsers as $user) {
            InternalUser::factory()->create($user);
        }

        // Create additional officers
        Officer::factory(2)->create();
    }

    private function createDemoApplications(): void
    {
        $scenarios = [
            // Draft applications
            [
                'customer_id' => 'CUST001',
                'license_type' => 'REST',
                'business_name' => 'Ahmad\'s Restaurant',
                'status' => 'DRAFT',
            ],
            [
                'customer_id' => 'CUST002',
                'license_type' => 'MINI_MARKET',
                'business_name' => 'Siti\'s Mini Mart',
                'status' => 'DRAFT',
            ],

            // Submitted applications
            [
                'customer_id' => 'CUST003',
                'license_type' => 'SERVICE',
                'business_name' => 'Raj Computer Services',
                'status' => 'SUBMITTED',
            ],
            [
                'customer_id' => 'CUST004',
                'license_type' => 'FOOD_STALL',
                'business_name' => 'Fatimah\'s Nasi Lemak Stall',
                'status' => 'SUBMITTED',
            ],

            // Under screening
            [
                'customer_id' => 'CUST005',
                'license_type' => 'SUPERMARKET',
                'business_name' => 'Zain Supermarket',
                'status' => 'IN_SCREENING',
            ],

            // Under review
            [
                'customer_id' => 'CUST001',
                'license_type' => 'CAFE',
                'business_name' => 'Ahmad\'s Café',
                'status' => 'UNDER_REVIEW',
            ],

            // Approved applications
            [
                'customer_id' => 'CUST002',
                'license_type' => 'BAKERY',
                'business_name' => 'Siti\'s Bakery',
                'status' => 'APPROVED',
            ],
            [
                'customer_id' => 'CUST003',
                'license_type' => 'REST_EXP',
                'business_name' => 'Raj Fast Food',
                'status' => 'APPROVED',
            ],

            // Rejected application
            [
                'customer_id' => 'CUST004',
                'license_type' => 'REST',
                'business_name' => 'Fatimah\'s Fine Dining',
                'status' => 'REJECTED',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $customer = Customer::where('pp_plg_pelangganid', $scenario['customer_id'])->first();
            $licenseType = LicenseType::where('code', $scenario['license_type'])->first();

            Application::factory()->create([
                'mhn_idpelanggan' => $customer->pp_plg_pelangganid,
                'mhn_idjenislesen' => $licenseType->id,
                'mhn_status' => $scenario['status'],
                'mhn_namaperniagaan' => $scenario['business_name'],
                'mhn_kdsrpbt' => $licenseType->pbt_code,
            ]);
        }
    }

    private function createDemoReviews(): void
    {
        $applications = Application::whereIn('mhn_status', ['IN_SCREENING', 'UNDER_REVIEW', 'APPROVED', 'REJECTED'])->get();

        foreach ($applications as $application) {
            // Create main review
            $review = Review::factory()->create([
                'smk_idpermohonan' => $application->mhn_id,
                'smk_status' => $application->mhn_status === 'APPROVED' ? 'COMPLETED' : 'IN_PROGRESS',
            ]);

            // Create technical reviews for applications under review
            if ($application->mhn_status === 'UNDER_REVIEW') {
                $technicalReviews = TechnicalReview::factory(2)->create([
                    'uls_idsemakan' => $review->smk_id,
                ]);

                // Create queries for technical review
                Query::factory()->create([
                    'query_application_id' => $application->mhn_id,
                    'query_review_id' => $review->smk_id,
                    'query_status' => 'PENDING',
                ]);

                // Create site visit linked to first technical review
                SiteVisit::factory()->create([
                    'site_visit_technical_review_id' => $technicalReviews->first()->uls_id,
                ]);
            }

            // Create recommendations for approved/rejected applications
            if (in_array($application->mhn_status, ['APPROVED', 'REJECTED'])) {
                Recommendation::factory()->create([
                    'recommendation_review_id' => $review->smk_id,
                    'recommendation_type' => $application->mhn_status === 'APPROVED' ? 'APPROVE' : 'REJECT',
                ]);
            }
        }
    }

    private function createDemoBills(): void
    {
        $applications = Application::where('mhn_status', '!=', 'DRAFT')->get();

        foreach ($applications as $application) {
            $bill = Bill::factory()->create([
                'bil_idpermohonan' => $application->mhn_id,
                'bil_status' => in_array($application->mhn_status, ['APPROVED', 'REJECTED']) ? 'PAID' : 'UNPAID',
            ]);

            // Create payment record for paid bills
            if ($bill->bil_status === 'PAID') {
                // This would normally be handled by payment service
            }
        }
    }

    private function createDemoLicenses(): void
    {
        $approvedApplications = Application::where('mhn_status', 'APPROVED')->get();

        foreach ($approvedApplications as $application) {
            License::factory()->create([
                'ind_idpermohonan' => $application->mhn_id,
                'ind_status' => 'ACTIVE',
            ]);
        }
    }

    private function createDemoMeetings(): void
    {
        // Create upcoming OSC meeting
        $upcomingMeeting = Meeting::factory()->create([
            'msy_bilangan' => 'M25-001',
            'msy_kertaskerja' => 'OSC/KK/2025/001',
            'msy_tarikh' => now()->addDays(7),
            'msy_statf' => 'B', // B = Belum Selesai (Scheduled/Not Completed)
        ]);

        // Create agenda for upcoming meeting
        $upcomingAgenda = MeetingAgenda::factory()->create([
            'agenda_meeting_number' => $upcomingMeeting->msy_bilangan,
            'agenda_title' => 'Meeting Agenda - January 2025',
            'agenda_description' => 'Review of new restaurant applications, renewal applications review, policy updates discussion, outstanding issues resolution',
        ]);

        // Create agenda items for the upcoming agenda
        MeetingAgendaItem::factory(4)->create([
            'item_agenda_id' => $upcomingAgenda->id,
        ]);

        // Create completed meeting
        $completedMeeting = Meeting::factory()->create([
            'msy_bilangan' => 'M24-012',
            'msy_kertaskerja' => 'OSC/KK/2024/012',
            'msy_tarikh' => now()->subDays(7),
            'msy_statf' => 'S', // S = Selesai (Completed)
        ]);

        // Create attendees for completed meeting
        MeetingAttendee::factory(6)->create([
            'attendee_meeting_number' => $completedMeeting->msy_bilangan,
        ]);

        // Create decisions from completed meeting
        MeetingDecision::factory(3)->create([
            'decision_meeting_number' => $completedMeeting->msy_bilangan,
        ]);

        // Create minutes
        MeetingMinute::factory()->create([
            'minute_meeting_number' => $completedMeeting->msy_bilangan,
        ]);
    }

    private function createDemoRenewals(): void
    {
        $licenses = License::where('ind_status', 'ACTIVE')->get();

        foreach ($licenses->take(3) as $license) {
            Renewal::factory()->create([
                'renewal_license_id' => $license->ind_id,
                'renewal_status' => 'submitted',
            ]);
        }
    }

    private function createStatusHistory(): void
    {
        $applications = Application::all();

        foreach ($applications as $application) {
            // Create status history entries based on current status
            $statuses = ['DRAFT', 'SUBMITTED', 'IN_SCREENING', 'UNDER_REVIEW', 'APPROVED', 'REJECTED'];

            $currentIndex = array_search($application->mhn_status, $statuses);
            if ($currentIndex !== false) {
                for ($i = 0; $i <= $currentIndex; $i++) {
                    StatusHistory::factory()->create([
                        'application_id' => $application->mhn_id,
                        'old_status' => $i > 0 ? $statuses[$i - 1] : null,
                        'new_status' => $statuses[$i],
                        'changed_by' => 'system',
                        'created_at' => now()->subDays($currentIndex - $i + 1),
                    ]);
                }
            } else {
                // For statuses not in the progression list, create at least one history entry
                StatusHistory::factory()->create([
                    'application_id' => $application->mhn_id,
                    'old_status' => 'DRAFT',
                    'new_status' => $application->mhn_status,
                    'changed_by' => 'system',
                    'created_at' => now()->subDays(1),
                ]);
            }
        }
    }
}