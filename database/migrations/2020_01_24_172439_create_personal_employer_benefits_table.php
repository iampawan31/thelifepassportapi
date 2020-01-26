<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalEmployerBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_employer_benefits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('benefit_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employer_id')->references('id')->on('user_employers');
            $table->foreign('benefit_id')->references('id')->on('employer_benefits_masters');
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
        Schema::dropIfExists('personal_employer_benefits');
    }
}