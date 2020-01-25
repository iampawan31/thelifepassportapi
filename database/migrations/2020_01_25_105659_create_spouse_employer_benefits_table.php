<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpouseEmployerBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouse_employer_benefits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('benefit_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employer_id')->references('id')->on('spouse_employers');
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
        Schema::dropIfExists('spouse_employer_benefits');
    }
}
