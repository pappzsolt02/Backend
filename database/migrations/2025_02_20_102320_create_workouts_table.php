<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->enum('muscleGroup', ['Mellkas', 'Hát', 'Lábak', 'Karok', 'Vállak', 'Has']);  // Enum column
            $table->string('name');
            $table->string('shortDescription');
            $table->text('description');
            $table->string('equipment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}
