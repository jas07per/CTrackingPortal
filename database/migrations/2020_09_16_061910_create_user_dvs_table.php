<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dvs', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('dv_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onCascade('delete');
            $table->foreign('dv_id')->references('id')->on('dvs')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_dvs');
    }
}
