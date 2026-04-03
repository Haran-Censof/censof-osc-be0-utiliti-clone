<?php

namespace Database\Seeders;

use App\Models\InternalUser;
use App\Models\Role;
use Illuminate\Database\Seeder;

class InternalUserRoleBackfillSeeder extends Seeder
{
    public function run(): void
    {
        $roleCodeMap = [
            'JKT' => ['super_admin'],
            'PBT' => ['admin_pbt'],
            'PBT-PPT' => ['ppkt1'],
            'PBT-PENYEMAK' => ['ppsu'],
            'ATL' => ['atl'],
            'ATL-PENYEMAK' => ['atl'],
            'ATL-KETUA-JABATAN' => ['atl'],
            'BTD' => ['btd'],
            'BTD-PENYEMAK' => ['btd'],
            'BTD-KETUA-JABATAN' => ['btd'],
            'PPSU' => ['ppsu'],
            'PPKT1' => ['ppkt1'],
            'PPKT2' => ['ppkt2'],
            'URUSETIA' => ['urusetia'],
            'PEGAWAI-PENGUATKUASA' => ['pegawai_penguatkuasa'],
            'PEGAWAI-KEWANGAN' => ['pegawai_kewangan'],
        ];

        $roles = Role::query()
            ->whereIn('role_code', collect($roleCodeMap)->flatten()->unique()->all())
            ->get()
            ->keyBy('role_code');

        $assignedCount = 0;

        InternalUser::query()
            ->whereNotNull('role')
            ->where('role', '!=', '')
            ->orderBy('id')
            ->chunkById(100, function ($users) use ($roleCodeMap, $roles, &$assignedCount) {
                foreach ($users as $user) {
                    $mappedRoleCodes = $roleCodeMap[$user->role] ?? [];

                    if ($mappedRoleCodes === []) {
                        continue;
                    }

                    $roleIds = collect($mappedRoleCodes)
                        ->map(fn (string $roleCode) => $roles->get($roleCode)?->id)
                        ->filter()
                        ->values();

                    if ($roleIds->isEmpty()) {
                        continue;
                    }

                    $payload = $roleIds
                        ->diff($user->roles()->pluck('roles.id'))
                        ->mapWithKeys(fn (int $roleId) => [
                            $roleId => [
                                'assigned_at' => now(),
                                'assigned_by' => 'SYSTEM',
                            ],
                        ])
                        ->all();

                    if ($payload === []) {
                        continue;
                    }

                    $user->roles()->syncWithoutDetaching($payload);
                    $assignedCount += count($payload);
                }
            }, 'id');

        $this->command?->info("Internal user role backfill complete. Assigned {$assignedCount} role link(s).");
    }
}
