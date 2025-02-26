<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img');
            $table->float('weight');
            $table->float('calories');
            $table->float('protein');
            $table->float('carbohydrate');
            $table->float('fat');
            $table->string('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
