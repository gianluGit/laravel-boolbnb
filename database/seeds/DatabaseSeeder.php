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
        $this->call([

          UserSeeder::class,
          SuiteSeeder::class,
          MessageSeeder::class,
          ComfortSeeder::class,
          VisitSeeder::class,
          PromotionSeeder::class

        ]);
    }
}
