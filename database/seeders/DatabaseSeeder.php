<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
