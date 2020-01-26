<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalDetailsStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_details_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('step', 100);
            $table->string('slug', 100);
            $table->tinyInteger('percentage');
            $table->tinyInteger('sequence');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('personal_details_steps');
    }
}
