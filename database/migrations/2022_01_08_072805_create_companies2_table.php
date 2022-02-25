<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanies2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tax_id');
            $table->string('country');
            $table->string('governate');
            $table->string('regionCity');
            $table->string('street');
            $table->string('buildingNumber');
            $table->string('postalCode')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->string('landmark')->nullable();
            $table->string('additionalInformation')->nullable();
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
        Schema::dropIfExists('companies2');
    }
}
