<?php

use Illuminate\Database\Seeder;
use App\Promotion;
use App\Suite;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Promotion::class, 3) -> create()
        -> each(function($prm) {
            $sui = Suite::inRandomOrder() -> take(5) -> distinct() -> get();
            $prm -> suites() -> attach($sui);
        });
    }
}
