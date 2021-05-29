<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sale_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pos_sale_id');
            $table->integer('product_id');
            $table->string('product_code',55);
            $table->string('product_name',255);
            $table->string('product_type',20);
            $table->integer('option_id')->default(null);
            $table->decimal('net_unit_price',25,4);
            $table->decimal('unit_price',25,4)->default(null);
            $table->decimal('quantity',15,4);
            $table->integer('warehouse_id')->default(null);
            $table->decimal('item_tax',25,4)->default(null);
            $table->integer('tax_rate_id')->default(null);
            $table->string('tax',55)->default(null);
            $table->string('discount',55)->default(null);
            $table->decimal('item_discount',25,4)->default(null);
            $table->decimal('subtotal',25,4);
            $table->decimal('real_unit_price',25,4)->default(null);
            $table->integer('sale_item_id')->default(null);
            $table->integer('product_unit_id')->default(null);
            $table->string('product_unit_code',10)->default(null);
            $table->decimal('unit_quantity',15,4);
            $table->string('comment',255)->default(null);
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
        Schema::dropIfExists('pos_sale_details');
    }
}
