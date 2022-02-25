<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->longText('description');
            $table->string('itemType');
            $table->string('itemCode');
            $table->string('unitType');
            $table->string('quantity');
            $table->string('internalCode');
            $table->string('salesTotal');
            $table->string('total');
            $table->string('valueDifference');
            $table->string('totalTaxableFees');
            $table->string('netTotal');
            $table->string('itemsDiscount');
            $table->string('currencySold');
            $table->string('amountEGP');
            $table->string('discountamount');
            $table->string('discountrate');
            $table->string('unittype');
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
        Schema::dropIfExists('orderitems');
    }
}
