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
            $table->boolean('is_filled');
            $table->boolean('is_completed')->default(false);
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_visited')->default(0);
            $table->timestamps();

            $table->foreign('step_id')->references('id')->on('personal_details_steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_personal_details_completions');
    }
}
