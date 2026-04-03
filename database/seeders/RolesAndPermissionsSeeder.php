<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array_merge(
            $this->profilePermissions(),
            $this->feAdminPermissions(),
        );

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['permission_code' => $permission['permission_code']],
                array_merge(['is_active' => true], $permission),
            );
        }

        foreach ($this->roles() as $roleData) {
            $role = Role::updateOrCreate(
                ['role_code' => $roleData['role_code']],
                $roleData
            );

            $permissionIds = Permission::whereIn(
                'permission_code',
                $this->rolePermissionMap()[$roleData['role_code']] ?? []
            )->pluck('id')->all();

            $role->permissions()->sync($permissionIds);
        }

        $this->command?->info('Roles and permissions seeded successfully.');
    }

    /**
     * Existing profile/admin permissions used by BE1.
     */
    private function profilePermissions(): array
    {
        return [
            ['permission_code' => 'customers.view', 'permission_name' => 'View Customers', 'description' => 'View customer profiles', 'module' => 'customers', 'action' => 'view'],
            ['permission_code' => 'customers.create', 'permission_name' => 'Create Customers', 'description' => 'Register new customers', 'module' => 'customers', 'action' => 'create'],
            ['permission_code' => 'customers.update', 'permission_name' => 'Update Customers', 'description' => 'Update customer profiles', 'module' => 'customers', 'action' => 'update'],
            ['permission_code' => 'customers.delete', 'permission_name' => 'Delete Customers', 'description' => 'Delete customer accounts', 'module' => 'customers', 'action' => 'delete'],
            ['permission_code' => 'customers.approve', 'permission_name' => 'Approve Customers', 'description' => 'Approve company registrations', 'module' => 'customers', 'action' => 'approve'],
            ['permission_code' => 'customers.suspend', 'permission_name' => 'Suspend Customers', 'description' => 'Suspend customer accounts', 'module' => 'customers', 'action' => 'suspend'],
            ['permission_code' => 'customers.unlock', 'permission_name' => 'Unlock Customers', 'description' => 'Unlock locked accounts', 'module' => 'customers', 'action' => 'unlock'],

            ['permission_code' => 'addresses.view', 'permission_name' => 'View Addresses', 'description' => 'View customer addresses', 'module' => 'addresses', 'action' => 'view'],
            ['permission_code' => 'addresses.create', 'permission_name' => 'Create Addresses', 'description' => 'Add new addresses', 'module' => 'addresses', 'action' => 'create'],
            ['permission_code' => 'addresses.update', 'permission_name' => 'Update Addresses', 'description' => 'Update addresses', 'module' => 'addresses', 'action' => 'update'],
            ['permission_code' => 'addresses.delete', 'permission_name' => 'Delete Addresses', 'description' => 'Delete addresses', 'module' => 'addresses', 'action' => 'delete'],

            ['permission_code' => 'documents.view', 'permission_name' => 'View Documents', 'description' => 'View uploaded documents', 'module' => 'documents', 'action' => 'view'],
            ['permission_code' => 'documents.upload', 'permission_name' => 'Upload Documents', 'description' => 'Upload new documents', 'module' => 'documents', 'action' => 'upload'],
            ['permission_code' => 'documents.download', 'permission_name' => 'Download Documents', 'description' => 'Download documents', 'module' => 'documents', 'action' => 'download'],
            ['permission_code' => 'documents.delete', 'permission_name' => 'Delete Documents', 'description' => 'Delete documents', 'module' => 'documents', 'action' => 'delete'],

            ['permission_code' => 'account-closure.request', 'permission_name' => 'Request Account Closure', 'description' => 'Request to close own account', 'module' => 'account_closure', 'action' => 'request'],
            ['permission_code' => 'account-closure.approve', 'permission_name' => 'Approve Account Closure', 'description' => 'Approve account closure requests', 'module' => 'account_closure', 'action' => 'approve'],
            ['permission_code' => 'account-closure.reject', 'permission_name' => 'Reject Account Closure', 'description' => 'Reject account closure requests', 'module' => 'account_closure', 'action' => 'reject'],

            ['permission_code' => 'audit-logs.view', 'permission_name' => 'View Audit Logs', 'description' => 'View system audit logs', 'module' => 'audit_logs', 'action' => 'view'],

            ['permission_code' => 'users.manage', 'permission_name' => 'Manage Users', 'description' => 'Manage system users and roles', 'module' => 'system', 'action' => 'manage_users'],
            ['permission_code' => 'roles.manage', 'permission_name' => 'Manage Roles', 'description' => 'Manage roles and permissions', 'module' => 'system', 'action' => 'manage_roles'],
            ['permission_code' => 'system.configure', 'permission_name' => 'Configure System', 'description' => 'Configure system parameters', 'module' => 'system', 'action' => 'configure'],
        ];
    }

    /**
     * Permission catalogue already used by fe-admin RBAC.
     */
    private function feAdminPermissions(): array
    {
        return [
            ['permission_code' => 'dashboard.view', 'permission_name' => 'View Dashboard', 'description' => 'Open the admin dashboard', 'module' => 'dashboard', 'action' => 'view'],

            ['permission_code' => 'users.view', 'permission_name' => 'View Users', 'description' => 'View internal users', 'module' => 'users', 'action' => 'view'],
            ['permission_code' => 'users.create', 'permission_name' => 'Create Users', 'description' => 'Create internal users', 'module' => 'users', 'action' => 'create'],
            ['permission_code' => 'users.update', 'permission_name' => 'Update Users', 'description' => 'Update internal users', 'module' => 'users', 'action' => 'update'],
            ['permission_code' => 'users.activity.view', 'permission_name' => 'View User Activity', 'description' => 'View internal user activity logs', 'module' => 'users', 'action' => 'activity_view'],

            ['permission_code' => 'profiles.view', 'permission_name' => 'View Profiles', 'description' => 'View public profiles', 'module' => 'profiles', 'action' => 'view'],
            ['permission_code' => 'profiles.update', 'permission_name' => 'Update Profiles', 'description' => 'Update public profiles', 'module' => 'profiles', 'action' => 'update'],
            ['permission_code' => 'profiles.activity.view', 'permission_name' => 'View Profile Activity', 'description' => 'View public profile activity logs', 'module' => 'profiles', 'action' => 'activity_view'],

            ['permission_code' => 'roles.view', 'permission_name' => 'View Roles', 'description' => 'View roles and their definitions', 'module' => 'roles', 'action' => 'view'],
            ['permission_code' => 'roles.create', 'permission_name' => 'Create Roles', 'description' => 'Create new roles', 'module' => 'roles', 'action' => 'create'],
            ['permission_code' => 'roles.update', 'permission_name' => 'Update Roles', 'description' => 'Update existing roles', 'module' => 'roles', 'action' => 'update'],
            ['permission_code' => 'roles.activate', 'permission_name' => 'Activate Roles', 'description' => 'Activate inactive roles', 'module' => 'roles', 'action' => 'activate'],
            ['permission_code' => 'roles.deactivate', 'permission_name' => 'Deactivate Roles', 'description' => 'Deactivate active roles', 'module' => 'roles', 'action' => 'deactivate'],
            ['permission_code' => 'roles.assign_permissions', 'permission_name' => 'Assign Role Permissions', 'description' => 'Assign permissions to roles', 'module' => 'roles', 'action' => 'assign_permissions'],
            ['permission_code' => 'roles.assign_users', 'permission_name' => 'Assign User Roles', 'description' => 'Assign and remove user roles', 'module' => 'roles', 'action' => 'assign_users'],

            ['permission_code' => 'permissions.view', 'permission_name' => 'View Permissions', 'description' => 'View permission catalogue', 'module' => 'permissions', 'action' => 'view'],
            ['permission_code' => 'permissions.create', 'permission_name' => 'Create Permissions', 'description' => 'Create new permissions', 'module' => 'permissions', 'action' => 'create'],
            ['permission_code' => 'permissions.update', 'permission_name' => 'Update Permissions', 'description' => 'Update existing permissions', 'module' => 'permissions', 'action' => 'update'],
            ['permission_code' => 'permissions.activate', 'permission_name' => 'Activate Permissions', 'description' => 'Activate inactive permissions', 'module' => 'permissions', 'action' => 'activate'],
            ['permission_code' => 'permissions.deactivate', 'permission_name' => 'Deactivate Permissions', 'description' => 'Deactivate active permissions', 'module' => 'permissions', 'action' => 'deactivate'],
            ['permission_code' => 'permissions.test_effective', 'permission_name' => 'Test Effective Permissions', 'description' => 'Inspect user effective permissions', 'module' => 'permissions', 'action' => 'test_effective'],

            ['permission_code' => 'applications.view', 'permission_name' => 'View Applications', 'description' => 'View application listing', 'module' => 'applications', 'action' => 'view'],
            ['permission_code' => 'applications.semakan.view', 'permission_name' => 'View Application Screening', 'description' => 'Open screening queue', 'module' => 'applications', 'action' => 'semakan_view'],
            ['permission_code' => 'applications.action.view', 'permission_name' => 'View Application Action Queue', 'description' => 'Open application action queue', 'module' => 'applications', 'action' => 'action_view'],
            ['permission_code' => 'applications.forward_next_stage', 'permission_name' => 'Forward Application to Next Stage', 'description' => 'Forward application to the next internal stage', 'module' => 'applications', 'action' => 'forward_next_stage'],
            ['permission_code' => 'applications.forward_agency_review', 'permission_name' => 'Forward Application to Agency Review', 'description' => 'Send application for agency review', 'module' => 'applications', 'action' => 'forward_agency_review'],
            ['permission_code' => 'applications.return_for_correction', 'permission_name' => 'Return Application for Correction', 'description' => 'Return application to applicant for correction', 'module' => 'applications', 'action' => 'return_for_correction'],
            ['permission_code' => 'applications.update_location', 'permission_name' => 'Update Application Location', 'description' => 'Update application map coordinates', 'module' => 'applications', 'action' => 'update_location'],
            ['permission_code' => 'applications.reassign_meeting', 'permission_name' => 'Reassign Application Meeting', 'description' => 'Reassign postponed application to another meeting', 'module' => 'applications', 'action' => 'reassign_meeting'],
            ['permission_code' => 'applications.approve', 'permission_name' => 'Approve Applications', 'description' => 'Approve applications', 'module' => 'applications', 'action' => 'approve'],
            ['permission_code' => 'applications.postpone', 'permission_name' => 'Postpone Applications', 'description' => 'Postpone applications', 'module' => 'applications', 'action' => 'postpone'],
            ['permission_code' => 'applications.reject', 'permission_name' => 'Reject Applications', 'description' => 'Reject applications', 'module' => 'applications', 'action' => 'reject'],

            ['permission_code' => 'meetings.view', 'permission_name' => 'View Meetings', 'description' => 'View meeting listings and details', 'module' => 'meetings', 'action' => 'view'],
            ['permission_code' => 'meetings.create', 'permission_name' => 'Create Meetings', 'description' => 'Create new meetings', 'module' => 'meetings', 'action' => 'create'],
            ['permission_code' => 'meetings.update', 'permission_name' => 'Update Meetings', 'description' => 'Update meeting details', 'module' => 'meetings', 'action' => 'update'],
            ['permission_code' => 'meetings.delete', 'permission_name' => 'Delete Meetings', 'description' => 'Delete meetings', 'module' => 'meetings', 'action' => 'delete'],
            ['permission_code' => 'meetings.members.manage', 'permission_name' => 'Manage Meeting Members', 'description' => 'Add, remove, and update meeting attendees', 'module' => 'meetings', 'action' => 'members_manage'],
            ['permission_code' => 'meetings.minutes.view', 'permission_name' => 'View Meeting Minutes', 'description' => 'View meeting minutes', 'module' => 'meetings', 'action' => 'minutes_view'],
            ['permission_code' => 'meetings.minutes.update', 'permission_name' => 'Update Meeting Minutes', 'description' => 'Update meeting minutes', 'module' => 'meetings', 'action' => 'minutes_update'],
            ['permission_code' => 'meetings.minutes.print', 'permission_name' => 'Print Meeting Minutes', 'description' => 'Print or download meeting minutes', 'module' => 'meetings', 'action' => 'minutes_print'],

            ['permission_code' => 'monitoring.view', 'permission_name' => 'View Monitoring', 'description' => 'View monitoring records', 'module' => 'monitoring', 'action' => 'view'],
            ['permission_code' => 'monitoring.create', 'permission_name' => 'Manage Monitoring', 'description' => 'Create and update monitoring records', 'module' => 'monitoring', 'action' => 'create'],

            ['permission_code' => 'comments.view', 'permission_name' => 'View Comments', 'description' => 'View application comments', 'module' => 'comments', 'action' => 'view'],
            ['permission_code' => 'comments.escalate', 'permission_name' => 'Escalate Comments', 'description' => 'Resubmit comments to the next stage', 'module' => 'comments', 'action' => 'escalate'],

            ['permission_code' => 'recommendations.view', 'permission_name' => 'View Recommendations', 'description' => 'View recommendation records', 'module' => 'recommendations', 'action' => 'view'],
            ['permission_code' => 'recommendations.create', 'permission_name' => 'Create Recommendations', 'description' => 'Create recommendation records', 'module' => 'recommendations', 'action' => 'create'],
            ['permission_code' => 'recommendations.update', 'permission_name' => 'Update Recommendations', 'description' => 'Update recommendation records and attachments', 'module' => 'recommendations', 'action' => 'update'],
            ['permission_code' => 'recommendations.review', 'permission_name' => 'Review Recommendations', 'description' => 'Approve or reject recommendation records', 'module' => 'recommendations', 'action' => 'review'],
            ['permission_code' => 'recommendations.escalate', 'permission_name' => 'Escalate Recommendations', 'description' => 'Resend approved recommendations', 'module' => 'recommendations', 'action' => 'escalate'],

            ['permission_code' => 'reports.view', 'permission_name' => 'View Reports', 'description' => 'Access reporting modules', 'module' => 'reports', 'action' => 'view'],

            ['permission_code' => 'complaints.view', 'permission_name' => 'View Complaints', 'description' => 'View complaints dashboard and complaint details', 'module' => 'complaints', 'action' => 'view'],
            ['permission_code' => 'complaints.reply', 'permission_name' => 'Handle Complaints', 'description' => 'Accept, reply to, close, and upload documents for complaints', 'module' => 'complaints', 'action' => 'reply'],
            ['permission_code' => 'complaints.reassign', 'permission_name' => 'Reassign Complaints', 'description' => 'Reassign complaints to another officer', 'module' => 'complaints', 'action' => 'reassign'],

            ['permission_code' => 'cancellations.view', 'permission_name' => 'View Cancellations', 'description' => 'View license cancellation requests', 'module' => 'cancellations', 'action' => 'view'],
            ['permission_code' => 'cancellations.process', 'permission_name' => 'Process Cancellations', 'description' => 'Confirm or reject cancellation requests', 'module' => 'cancellations', 'action' => 'process'],

            ['permission_code' => 'certificates.view', 'permission_name' => 'View Certificates', 'description' => 'View certificate issuance screens and listings', 'module' => 'certificates', 'action' => 'view'],
            ['permission_code' => 'certificates.manage', 'permission_name' => 'Manage Certificates', 'description' => 'Generate, cancel, and reissue certificates', 'module' => 'certificates', 'action' => 'manage'],

            ['permission_code' => 'master_data.view', 'permission_name' => 'View Master Data', 'description' => 'Access master data maintenance modules', 'module' => 'master_data', 'action' => 'view'],
            ['permission_code' => 'email_templates.view', 'permission_name' => 'View Email Templates', 'description' => 'Access email template management', 'module' => 'email_templates', 'action' => 'view'],
            ['permission_code' => 'notifications.view', 'permission_name' => 'View Notifications', 'description' => 'Access notification management', 'module' => 'notifications', 'action' => 'view'],
        ];
    }

    private function roles(): array
    {
        return [
            [
                'role_code' => 'super_admin',
                'role_name' => 'Super Administrator',
                'description' => 'Full system access with all permissions',
                'is_system_role' => true,
                'hierarchy_level' => 1,
                'is_active' => true,
            ],
            [
                'role_code' => 'admin_pbt',
                'role_name' => 'Pentadbir Sistem PBT',
                'description' => 'PBT system administrator for users, roles, settings, and operational modules',
                'is_system_role' => true,
                'hierarchy_level' => 2,
                'is_active' => true,
            ],
            [
                'role_code' => 'ppkt2',
                'role_name' => 'Pegawai Pelulus Tahap 2 / Ahli Jawatankuasa',
                'description' => 'Final approval role for escalated or high-risk cases',
                'is_system_role' => true,
                'hierarchy_level' => 3,
                'is_active' => true,
            ],
            [
                'role_code' => 'ppkt1',
                'role_name' => 'Pegawai Pelulus Tahap 1',
                'description' => 'Approval role for operational licensing decisions',
                'is_system_role' => true,
                'hierarchy_level' => 4,
                'is_active' => true,
            ],
            [
                'role_code' => 'ppsu',
                'role_name' => 'Pegawai Pemproses Pelesenan',
                'description' => 'Operational processing role for applications and recommendations',
                'is_system_role' => true,
                'hierarchy_level' => 5,
                'is_active' => true,
            ],
            [
                'role_code' => 'urusetia',
                'role_name' => 'Urusetia Mesyuarat',
                'description' => 'Meeting and scheduling support role',
                'is_system_role' => true,
                'hierarchy_level' => 5,
                'is_active' => true,
            ],
            [
                'role_code' => 'btd',
                'role_name' => 'Pegawai Bahagian Teknikal Dalaman',
                'description' => 'Internal technical review and complaint handling role',
                'is_system_role' => true,
                'hierarchy_level' => 6,
                'is_active' => true,
            ],
            [
                'role_code' => 'atl',
                'role_name' => 'Pegawai Agensi Teknikal Luar',
                'description' => 'External technical review role',
                'is_system_role' => true,
                'hierarchy_level' => 6,
                'is_active' => true,
            ],
            [
                'role_code' => 'pegawai_penguatkuasa',
                'role_name' => 'Pegawai Penguatkuasa',
                'description' => 'Enforcement and field monitoring role',
                'is_system_role' => true,
                'hierarchy_level' => 7,
                'is_active' => true,
            ],
            [
                'role_code' => 'pegawai_kewangan',
                'role_name' => 'Pegawai Kewangan PBT',
                'description' => 'Finance and reporting role',
                'is_system_role' => true,
                'hierarchy_level' => 7,
                'is_active' => true,
            ],
            [
                'role_code' => 'applicant',
                'role_name' => 'Pemohon / Pemegang Lesen',
                'description' => 'Applicant or license holder role',
                'is_system_role' => true,
                'hierarchy_level' => 10,
                'is_active' => true,
            ],
        ];
    }

    private function rolePermissionMap(): array
    {
        return [
            'super_admin' => Permission::query()->pluck('permission_code')->all(),

            'admin_pbt' => [
                'dashboard.view',
                'users.view',
                'users.create',
                'users.update',
                'users.activity.view',
                'profiles.view',
                'profiles.update',
                'profiles.activity.view',
                'applications.view',
                'applications.semakan.view',
                'applications.action.view',
                'applications.forward_next_stage',
                'applications.forward_agency_review',
                'applications.return_for_correction',
                'applications.update_location',
                'applications.reassign_meeting',
                'applications.approve',
                'applications.postpone',
                'applications.reject',
                'meetings.view',
                'meetings.create',
                'meetings.update',
                'meetings.delete',
                'meetings.members.manage',
                'meetings.minutes.view',
                'meetings.minutes.update',
                'meetings.minutes.print',
                'monitoring.view',
                'monitoring.create',
                'comments.view',
                'comments.escalate',
                'recommendations.view',
                'recommendations.create',
                'recommendations.update',
                'recommendations.review',
                'recommendations.escalate',
                'reports.view',
                'complaints.view',
                'complaints.reply',
                'complaints.reassign',
                'cancellations.view',
                'cancellations.process',
                'certificates.view',
                'certificates.manage',
                'master_data.view',
                'email_templates.view',
                'notifications.view',
                'customers.view',
                'customers.approve',
                'customers.suspend',
                'customers.unlock',
                'addresses.view',
                'documents.view',
                'documents.download',
                'account-closure.approve',
                'account-closure.reject',
                'audit-logs.view',
                'users.manage',
                'system.configure',
            ],

            'ppkt2' => [
                'dashboard.view',
                'applications.view',
                'applications.approve',
                'applications.postpone',
                'applications.reject',
                'comments.view',
                'recommendations.view',
                'recommendations.review',
                'recommendations.escalate',
                'reports.view',
                'complaints.view',
                'customers.view',
                'customers.approve',
                'addresses.view',
                'documents.view',
                'documents.download',
                'account-closure.approve',
                'account-closure.reject',
                'audit-logs.view',
            ],

            'ppkt1' => [
                'dashboard.view',
                'applications.view',
                'applications.forward_agency_review',
                'applications.approve',
                'applications.reject',
                'meetings.view',
                'meetings.create',
                'meetings.update',
                'meetings.members.manage',
                'meetings.minutes.view',
                'meetings.minutes.update',
                'meetings.minutes.print',
                'comments.view',
                'recommendations.view',
                'recommendations.review',
                'reports.view',
                'complaints.view',
                'cancellations.view',
                'cancellations.process',
                'certificates.view',
                'certificates.manage',
                'customers.view',
                'customers.approve',
                'addresses.view',
                'documents.view',
                'documents.download',
                'audit-logs.view',
            ],

            'ppsu' => [
                'dashboard.view',
                'applications.view',
                'applications.semakan.view',
                'applications.action.view',
                'applications.forward_next_stage',
                'applications.forward_agency_review',
                'applications.return_for_correction',
                'applications.update_location',
                'applications.reject',
                'meetings.view',
                'monitoring.view',
                'monitoring.create',
                'comments.view',
                'comments.escalate',
                'recommendations.view',
                'recommendations.create',
                'recommendations.update',
                'complaints.view',
                'complaints.reply',
                'cancellations.view',
                'certificates.view',
                'reports.view',
                'customers.view',
                'addresses.view',
                'documents.view',
                'documents.download',
                'audit-logs.view',
            ],

            'urusetia' => [
                'dashboard.view',
                'applications.view',
                'applications.reassign_meeting',
                'meetings.view',
                'meetings.create',
                'meetings.update',
                'meetings.delete',
                'meetings.members.manage',
                'meetings.minutes.view',
                'meetings.minutes.update',
                'meetings.minutes.print',
                'monitoring.view',
                'comments.view',
                'recommendations.view',
                'reports.view',
                'complaints.view',
                'cancellations.view',
                'cancellations.process',
                'certificates.view',
                'certificates.manage',
                'customers.view',
                'addresses.view',
                'documents.view',
                'documents.download',
                'audit-logs.view',
            ],

            'btd' => [
                'dashboard.view',
                'comments.view',
                'recommendations.view',
                'recommendations.create',
                'recommendations.update',
                'recommendations.review',
                'recommendations.escalate',
                'complaints.view',
                'complaints.reply',
                'complaints.reassign',
                'customers.view',
                'addresses.view',
                'documents.view',
                'documents.download',
                'documents.upload',
                'audit-logs.view',
            ],

            'atl' => [
                'dashboard.view',
                'comments.view',
                'recommendations.view',
                'recommendations.create',
                'recommendations.update',
                'recommendations.review',
                'recommendations.escalate',
                'customers.view',
                'addresses.view',
                'documents.view',
                'documents.download',
                'documents.upload',
                'audit-logs.view',
            ],

            'pegawai_penguatkuasa' => [
                'dashboard.view',
                'monitoring.view',
                'complaints.view',
                'customers.view',
                'addresses.view',
                'documents.view',
                'audit-logs.view',
            ],

            'pegawai_kewangan' => [
                'dashboard.view',
                'reports.view',
                'complaints.view',
                'customers.view',
                'addresses.view',
                'documents.view',
                'audit-logs.view',
            ],

            'applicant' => [
                'customers.view',
                'customers.update',
                'addresses.view',
                'addresses.create',
                'addresses.update',
                'addresses.delete',
                'documents.view',
                'documents.upload',
                'documents.download',
                'account-closure.request',
            ],
        ];
    }
}
