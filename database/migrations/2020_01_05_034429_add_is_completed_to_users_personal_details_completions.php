<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCompletedToUsersPersonalDetailsCompletions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_personal_details_completions', function (Blueprint $table) {
            $table->enum('is_completed', [0, 1])->default('0')->comment('0=>Not Completed, 1=>Completed')->after('is_filled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_personal_details_completions', function (Blueprint $table) {
            //
        });
    }
}
