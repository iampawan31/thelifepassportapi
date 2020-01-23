<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStreetCityStateZipcodeToPersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_info', function (Blueprint $table) {
            $table->string('street_address1', 255)->after('home_address')->nullable();
            $table->string('street_address2', 255)->after('street_address1')->nullable();
            $table->string('city', 255)->after('street_address2')->nullable();
            $table->string('state', 255)->after('city')->nullable();
            $table->string('zipcode', 8)->after('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_info', function (Blueprint $table) {
            //
        });
    }
}
