<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblFastbankingFranchise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fastbanking_franchise', function (Blueprint $table) {
            $table->increments('franchise_id');
            $table->string('first_name',250)->nullable();
            $table->string('last_name',250)->nullable();
            $table->string('email',100)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('office_phone_number_1',20)->nullable();
            $table->string('address_line1',200)->nullable();
            $table->string('address_line2',200)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->integer('pincode')->nullable();
            $table->dateTime('date_activated')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
            $table->enum('is_registration_completed', ['0', '1'])->default('0');
            $table->string('logo_url',250)->nullable();
            $table->string('bank_ifsc_code',20)->nullable();
            $table->string('bank_account_number',50)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('account_holder_name',100)->nullable();
            $table->string('bank_branch',50)->nullable();
            $table->string('pan_card',20)->nullable();
            $table->float('monthly_income',10,2)->nullable();
            $table->string('business_name',255)->nullable();
            $table->string('business_address',255)->nullable();
            $table->string('business_type',255)->nullable();
            $table->string('business_pan',20)->nullable();
            $table->string('gst_number',100)->nullable();
            $table->string('reference_no',10)->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('tbl_fastbanking_franchise_users', function (Blueprint $table) {
            $table->increments('franchise_user_id');
            $table->string('first_name',250)->nullable();
            $table->string('last_name',250)->nullable();
            $table->string('email',100)->nullable();
            $table->string('login_password',500)->nullable();
            $table->string('mobile',20)->nullable();
            $table->integer('franchise_id')->nullable();
            $table->string('address_line1',200)->nullable();
            $table->string('address_line2',200)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->text('gcm_id')->nullable();
            $table->dateTime('gcm_login_date')->nullable();
            $table->enum('role', ['ADMIN', 'MANAGER','USER'])->default('USER');
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_fastbanking_franchise');
        Schema::dropIfExists('tbl_fastbanking_franchise_users');
    }
}
