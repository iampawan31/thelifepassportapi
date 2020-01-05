<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressDivorceAgreementAlimonyAmountToPreviousSpouseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('previous_spouse_infos', function (Blueprint $table) {
            $table->text('address')->nullable()->after('email');
            $table->string('divorce_agreement_doc', 500)->nullable()->after('address');
            $table->decimal('alimony_amount', 8, 2)->nullable()->after('divorce_agreement_doc');
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
