<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsVisitedToUsersPersonalDetailsCompletions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_personal_details_completions', function (Blueprint $table) {
            $table->enum('is_visited', [0, 1])->default(0)->after('user_id')->comment('0=>Not Visited, 1=>Visited');
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
