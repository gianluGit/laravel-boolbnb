<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionSuiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_suite', function (Blueprint $table) {

            $table->id();

            $table -> foreignId('promotion_id');
            $table -> foreignId('suite_id');
            $table -> date('start_date') -> nullable();
            $table -> date('end_date') -> nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_suite');
    }
}
