<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issures', function (Blueprint $table) {
            $table->id();
            $table->string('branchID')->nullable();
            $table->string('country')->nullable();
            $table->string('governate')->nullable();
            $table->string('regionCity')->nullable();
            $table->string('street')->nullable();
            $table->string('buildingNumber')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->string('landmark')->nullable();
            $table->string('additionalInformation')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('regid')->nullable();
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
        Schema::dropIfExists('issures');
    }
}
