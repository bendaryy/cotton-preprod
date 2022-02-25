<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxtypes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name_en');
            $table->string('name_ar');
            $table->enum('type',['amount', 'percentage']);
            $table->string('parent')->nullable();
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
        Schema::dropIfExists('taxtypes');
    }
}
