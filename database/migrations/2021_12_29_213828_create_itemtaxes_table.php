<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemtaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemtaxes', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned();
            $table->string('taxType');
            $table->string('amount');
            $table->string('subType');
            $table->string('rate');
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
        Schema::dropIfExists('itemtaxes');
    }
}
