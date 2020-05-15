<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_assistants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('person_name')->nullable();
            $table->string('provider_name')->nullable();
            $table->enum('assistant_frequency', [1,2,3,4,5,6,7])->comment('1=>One Time,2=>Daily,3=>Weekly,4=>Monthly,5=>Quaterly,6=>Half Yearly,7=>Yearly');
            $table->date('care_date')->nullable();
            $table->time('care_time')->nullable();
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
        Schema::dropIfExists('home_assistants');
    }
}
