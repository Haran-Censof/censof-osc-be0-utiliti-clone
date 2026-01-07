<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('osc_slg_menugrp')->insert([
            [
                'ID' =>1,
                'MENU_GROUP_ID' =>'MENU0',
                'MENU_GROUP_DESC' =>'Menu Utama',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>2,
                'MENU_GROUP_ID' =>'MENU1',
                'MENU_GROUP_DESC' =>'Fail-Fail Kod',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>3,
                'MENU_GROUP_ID' =>'MENU4',
                'MENU_GROUP_DESC' =>'Pemprosesan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>4,
                'MENU_GROUP_ID' =>'MENU6',
                'MENU_GROUP_DESC' =>'Pertanyaan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>5,
                'MENU_GROUP_ID' =>'MENU5',
                'MENU_GROUP_DESC' =>'Laporan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>6,
                'MENU_GROUP_ID' =>'MENU2',
                'MENU_GROUP_DESC' =>'Permohonan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>7,
                'MENU_GROUP_ID' =>'MENU3',
                'MENU_GROUP_DESC' =>'Penyelenggaraan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>8,
                'MENU_GROUP_ID' =>'MENU53',
                'MENU_GROUP_DESC' =>'Statistik',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>9,
                'MENU_GROUP_ID' =>'MENU51',
                'MENU_GROUP_DESC' =>'Cetakan Pre-Printed',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ],
            [
                'ID' =>10,
                'MENU_GROUP_ID' =>'MENU52',
                'MENU_GROUP_DESC' =>'Kewangan',
                'MENU_GROUP_IUSER' =>null,
                'MENU_GROUP_UUSER' =>null
            ]
        ]);
    }
}
