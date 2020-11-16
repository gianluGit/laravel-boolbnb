<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suites', function (Blueprint $table) {
          $table->id();

          $table->string('title');
          $table->integer('room_number');
          $table->integer('bed_number');
          $table->integer('bathroom_number');
          $table->integer('meters');
          $table->string('city');
          $table->string('street');
          $table->string('postal_code');
          $table->decimal('latitude', 10, 8) -> default(00.00000000);
          $table->decimal('longitude', 11, 8) -> default(00.00000000);
          $table->string('picture');
          $table->boolean('visible') -> default(true);
          $table->foreignId('user_id');

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
        Schema::dropIfExists('suites');
    }
}
