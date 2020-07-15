<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
            AccordTableSeeder::class,
            IngredientTableSeeder::class,
            BrandTierTableSeeder::class,
            FragranceTypeTableSeeder::class,
            ProfessionTableSeeder::class,
            SkinTypeTableSeeder::class,
            ClimateTableSeeder::class,
            SeasonTableSeeder::class,

            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,

            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
        ]);
    }
}
