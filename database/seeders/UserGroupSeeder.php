<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_slg_usergrp')->insert([
            [
                'ID' =>1,
                'USER_GROUP_ID' =>'ENDUSER',
                'USER_GROUP_DESC' =>'PENGGUNA AKHIR',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>2,
                'USER_GROUP_ID' =>'QUERYONLY',
                'USER_GROUP_DESC' =>'HANYA QUERY',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>3,
                'USER_GROUP_ID' =>'SYSDVLOPER',
                'USER_GROUP_DESC' =>'PEMBINA SISTEM',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>4,
                'USER_GROUP_ID' =>'SUPERUSER',
                'USER_GROUP_DESC' =>'PENGGUNA SUPER',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>5,
                'USER_GROUP_ID' =>'TPHPNYEDIA',
                'USER_GROUP_DESC' =>'PEGAWAI KAUNTER TEMPAHAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>'Y',
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>6,
                'USER_GROUP_ID' =>'TPHPNYEMAK',
                'USER_GROUP_DESC' =>'PEGAWAI PENYEMAK TEMPAHAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>7,
                'USER_GROUP_ID' =>'TPHPNGESAH',
                'USER_GROUP_DESC' =>'PEGAWAI PENGESAH TEMPAHAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>8,
                'USER_GROUP_ID' =>'PBGPNYEMAK',
                'USER_GROUP_DESC' =>'PEGAWAI PENYEMAK BIL PELBAGAI',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>9,
                'USER_GROUP_ID' =>'PBGPNYEDIA',
                'USER_GROUP_DESC' =>'PEGAWAI PENYEDIA BIL PELBAGAI',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>10,
                'USER_GROUP_ID' =>'PBGPNGESAH',
                'USER_GROUP_DESC' =>'PEGAWAI PENGESAH BIL PELBAGAI',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>11,
                'USER_GROUP_ID' =>'SWNPNYEDIA',
                'USER_GROUP_DESC' =>'PEGAWAI KAUNTER SEWAAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>'Y',
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>12,
                'USER_GROUP_ID' =>'SWNPNGESAH',
                'USER_GROUP_DESC' =>'PEGAWAI PENGESAH SEWAAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ],
            [
                'ID' =>13,
                'USER_GROUP_ID' =>'SWNPNYEMAK',
                'USER_GROUP_DESC' =>'PEGAWAI PENYEMAK SEWAAN',
                'NEW_GROUP_ID' =>null,
                'USER_KAUNTER' =>null,
                'USER_IUSER' =>null,
                'USER_UUSER' =>null
            ]
        ]);
    }
}
