<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPersonalDetailsCompletionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_personal_details_completions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('step_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('is_filled', [0,1])->comment('0=>No, 1=>Yes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('step_id')->references('id')->on('personal_details_steps');
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
        Schema::dropIfExists('personal_details_completions');
    }
}
