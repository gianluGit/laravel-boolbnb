<?php

use Illuminate\Database\Seeder;
use App\Suite;
use App\User;

class SuiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Suite::class, 100)
                -> make()
                -> each(function ($sui) {
                  $usr = User::inRandomOrder() -> first();
                  $sui -> user() -> associate($usr);
                  $sui -> save();
                });
    }
}
