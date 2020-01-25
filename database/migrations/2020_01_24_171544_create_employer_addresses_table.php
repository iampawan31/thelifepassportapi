<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employer_id');
            $table->string('street_address1');
            $table->string('street_address2');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode', 8);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employer_id')->references('id')->on('user_employers');
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
        Schema::dropIfExists('employer_addresses');
    }
}
