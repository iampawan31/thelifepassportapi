<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IsChildSupportChildSupportAmountToPreviousSpouseInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('previous_spouse_infos', function (Blueprint $table) {
            $table->boolean('is_child_support')->after('alimony_amount')->default(false);
            $table->decimal('child_support_amount', 8, 2)->after('is_child_support')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('previous_spouse_infos', function (Blueprint $table) {
            //
        });
    }
}
