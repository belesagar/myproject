<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewAccountTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //This code for creating account type colomn
        Schema::table('tbl_fastbanking_franchise', function (Blueprint $table) {
             $table->string('account_type',200)->nullable()->after('bank_branch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('tbl_fastbanking_franchise', function (Blueprint $table) {
             $table->dropColumn('account_type');
        });
    }
}
