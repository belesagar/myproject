<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifiedFranchiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('tbl_fastbanking_franchise', function (Blueprint $table) {
             $table->string('adhar_card',50)->nullable();
             $table->string('franchise_shop_size',100)->nullable(); 
             $table->string('franchise_latitude',50)->nullable();
             $table->string('franchise_longitude',50)->nullable();
             $table->string('franchise_category',100)->nullable();
             $table->string('franchise_service',100)->nullable();  

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
             $table->dropColumn('adhar_card');
             $table->dropColumn('franchise_shop_size'); 
             $table->dropColumn('franchise_latitude');
             $table->dropColumn('franchise_longitude');
             $table->dropColumn('franchise_category'); 
             $table->dropColumn('franchise_service'); 
        });
    }
}
