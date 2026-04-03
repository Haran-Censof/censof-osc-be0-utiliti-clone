<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OscKodMajlisSeeder::class,          // Run first - might be referenced by other tables
            OscKodAgensiSeeder::class,
            OscKodAktakompaunSeeder::class,
            OscKodJenisSeeder::class,
            OscKodSektorSeeder::class,
            OscKodAktivitiSeeder::class,
            OscKodDokumenSeeder::class,
            OscKodImageSeeder::class,
            OscKodJenisaduanSeeder::class,
            OscKodUndangSeeder::class,
            OscKodKesalahanSeeder::class,
            OscKodListhitamSeeder::class,
            OscKodLokasiSeeder::class,
            OscKodNiagaSeeder::class,
            OscKodPoskodSeeder::class,
            OscKodPtjpkSeeder::class,
            OscKodTranlesenSeeder::class,
            SystemParameterSeeder::class,
            MenuGroupSeeder::class,
            UserGroupSeeder::class,
            ControlCodeSeeder::class,
            ApplicationStatusSeeder::class,
            MenuSeeder::class,
            UserSeeder::class,
            MenuControlSeeder::class,
            PersoneliaKakitanganSeeder::class,
            IndukLPekerjaSeeder::class,
            CompanyProfileSeeder::class,
            IklanPelesenanSeeder::class,
            FacilitySeeder::class,
            IndukLNominiSeeder::class,
            CustomerSeeder::class,
            AddressSeeder::class,
            IndukLesenSeeder::class,
            LicensingTransactionSeeder::class,
            IndividualProfileSeeder::class,
            SyorKeputusanSeeder::class,
            CustomerUserSeeder::class,
            RealisticApplicationSeeder::class,
            RenewalSampleDataSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
