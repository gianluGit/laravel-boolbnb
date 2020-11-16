<?php

use Illuminate\Database\Seeder;
use App\Visit;
use App\Suite;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Visit::class, 100)
            -> make()
            -> each(function($vst) {
              $sui = Suite::inRandomOrder() -> first();
              $vst -> suite() -> associate($sui);
              $vst -> save();
            });
    }
}
