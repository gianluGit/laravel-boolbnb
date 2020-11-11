<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('suites', function (Blueprint $table){

         $table -> foreign('user_id', 'sui-usr')
                -> references('id')
                -> on('users');
       });


       Schema::table('messages', function (Blueprint $table) {

         $table -> foreign('suite_id', 'msg-sui')
                -> references('id')
                -> onDelete('cascade')
                -> on('suites');

       });

       Schema::table('visits', function (Blueprint $table) {

         $table -> foreign('suite_id', 'vst-sui')
                -> references('id')
                -> onDelete('cascade')
                -> on('suites');

       });

       Schema::table('promotion_suite', function (Blueprint $table) {

         $table -> foreign('promotion_id', 'sui-prm')
                -> references('id')
                -> on('promotions');

         $table -> foreign('suite_id', 'prm-sui')
                -> references('id')
                -> onDelete('cascade')
                -> on('suites');

       });

       Schema::table('comfort_suite', function (Blueprint $table) {

         $table -> foreign('comfort_id', 'sui-cmf')
                -> references('id')
                -> on('comforts');

         $table -> foreign('suite_id', 'cmf-sui')
                -> references('id')
                -> onDelete('cascade')
                -> on('suites');

       });

     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('suites', function (Blueprint $table) {

           $table -> dropForeign('sui-usr');

         });

         Schema::table('messages', function (Blueprint $table) {

           $table -> dropForeign('msg-sui');

         });

         Schema::table('visits', function (Blueprint $table) {

           $table -> dropForeign('vst-sui');

         });


         Schema::table('promotion_suite', function (Blueprint $table) {

           $table -> dropForeign('sui-prm');
           $table -> dropForeign('prm-sui');

         });

         Schema::table('comfort_suite', function (Blueprint $table) {

           $table -> dropForeign('sui-cmf');
           $table -> dropForeign('cmf-sui');

         });



    }
}
