<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\Suite;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Message::class, 200)
              -> make()
              -> each(function($msg) {
                $sui = Suite::inRandomOrder() -> first();
                $msg -> suite() -> associate($sui);
                $msg -> save();
              });
    }
}
