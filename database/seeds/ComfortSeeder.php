<?php

use Illuminate\Database\Seeder;
use App\Comfort;
use App\Suite;

class ComfortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Comfort::class, 10) -> create()
          -> each(function($cmf) {
            $sui = Suite::inRandomOrder() -> take(rand(1, 100)) -> distinct() -> get();
            $cmf -> suites() -> attach($sui);
        });
    }
}
