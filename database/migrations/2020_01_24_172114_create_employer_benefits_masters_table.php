<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerBenefitsMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_benefits_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->enum('status', [0, 1])->default('1')->comment('0=>Inactive, 1=>active');
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
        Schema::dropIfExists('employer_benefits_masters');
    }
}
