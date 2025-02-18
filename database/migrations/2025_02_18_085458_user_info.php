<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    public function up()
    {
        Schema::create('userInfo', function (Blueprint $table) {
            $table->id('UserID');
            $table->float('Height');
            $table->float('Weight');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userInfo');
    }
}
