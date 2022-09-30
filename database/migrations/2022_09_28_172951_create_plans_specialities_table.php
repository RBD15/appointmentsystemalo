<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_specialities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('speciality_id')->constrained('specialities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('plans_specialities');
    }
}
