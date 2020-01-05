<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousSpouseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_spouse_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('legal_name', 255)->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('marriage_location', 255)->nullable();
            $table->date('divorce_date')->nullable();
            $table->string('divorce_location', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->enum('is_alimony_paid', [0, 1])->comment('0=> No, 1=>Yes');
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
        Schema::dropIfExists('previous_spouse_infos');
    }
}
