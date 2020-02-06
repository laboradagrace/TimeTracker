<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTimeInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertime_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->String('clockIn');
            $table->String('clockOut');
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
         Schema::dropIfExists('usertime_infos');
    }
}
