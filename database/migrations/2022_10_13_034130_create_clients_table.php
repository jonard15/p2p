<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('application_type')->nullable();
            $table->string('account_no')->index()->unique();
            $table->string('name', 500)->nullable();
            $table->string('ext_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('landline_number')->nullable();
            $table->string('email', 500)->nullable();
            $table->string('present_house_no', 500)->nullable();
            $table->string('present_street', 500)->nullable();
            $table->string('present_address_brgy', 500)->nullable();
            $table->string('present_address_muncity', 500)->nullable();
            $table->string('present_address_province', 500)->nullable();
            $table->string('present_address_region', 500)->nullable();
            $table->string('permanent_house_no', 500)->nullable();
            $table->string('permanent_street', 500)->nullable();
            $table->string('permanent_address_brgy', 500)->nullable();
            $table->string('permanent_address_muncity', 500)->nullable();
            $table->string('permanent_address_province', 500)->nullable();
            $table->string('permanent_address_region', 500)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality', 500)->nullable();
            $table->string('birth_place', 500)->nullable();
            $table->string('client_sex', 500)->nullable();
            $table->string('civil_status', 500)->nullable();
            $table->string('client_status', 500)->nullable();
            $table->date('date_deceased')->nullable();
            $table->date('date_registered')->nullable();
            $table->string('industry', 500)->nullable();
            $table->string('tin', 500)->nullable();
            $table->string('representative_name', 500)->nullable();
            $table->string('company_id', 500)->nullable();
            $table->string('ownership', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
