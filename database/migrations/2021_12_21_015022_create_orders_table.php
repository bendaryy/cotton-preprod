<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("tax_rate")->nullable();
            $table->string("subtotal")->nullable();
            $table->integer("customer_id")->unsigned()->nullable();
            $table->string("shipping")->nullable();
            $table->string("tax-total")->nullable();
            $table->string("discount-total")->nullable();
            $table->string("total_quantity")->nullable();
            $table->string("total_price")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("bank_accountno")->nullable();
            $table->string("swift_code")->nullable();
            $table->string("bank_iban")->nullable();
            $table->string("bank_address")->nullable();
            $table->string("payment_terms")->nullable();
            $table->string("order_purchase_ref")->nullable();
            $table->string("order_desc")->nullable();
            $table->string("orderder_reference")->nullable();
            $table->string("order_sales_desc")->nullable();
            $table->string("proforma")->nullable();
            $table->string("approach")->nullable();
            $table->string("packaging")->nullable();
            $table->string("validity")->nullable();
            $table->string("export_port")->nullable();
            $table->string("country_origin")->nullable();
            $table->string("cross_weight")->nullable();
            $table->string("net_weight")->nullable();
            $table->string("delivery_terms")->nullable();
            $table->string("document_version")->nullable();
            $table->string("document_type")->nullable();
            $table->string("dateTimeIssued")->nullable();
            $table->string("discount")->nullable();
            $table->string("internalid")->nullable()->unique();
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('orders');
    }
}
