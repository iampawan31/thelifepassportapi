<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('legal_name', 255);
            $table->string('nickname', 255)->nullable();
            $table->text('home_address')->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('passport_number', 50)->nullable();
            $table->string('father_name', 255)->nullable();
            $table->string('father_birth_place', 255)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->string('mother_birth_place', 255)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('personal_info');
    }
}
