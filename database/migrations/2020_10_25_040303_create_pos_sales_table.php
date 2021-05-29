<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_no',55);
            $table->integer('customer_id');
            $table->string('customer',55);
            $table->integer('biller_id');
            $table->string('biller');
            $table->integer('warehouse_id')->default(null);
            $table->string('note',1000)->default(null);
            $table->string('staff_note')->default(null);
            $table->decimal('total',25,4);
            $table->decimal('product_discount',25,4);
            $table->string('order_discount_id',20);
            $table->decimal('total_discount',25,4);
            $table->decimal('order_discount',25,4);
            $table->decimal('product_tax')->default(0);
            $table->integer('order_tax_id')->default(null);
            $table->decimal('order_tax')->default(0);
            $table->decimal('total_tax')->default(0);
            $table->decimal('shipping')->default(0);
            $table->decimal('grand_total');
            $table->string('sale_status',20);
            $table->string('payment_status',20)->default(null);
            $table->tinyInteger('payment_term')->default(null);
            $table->timestamp('due_date')->default(null);
            $table->tinyInteger('total_items')->default(null);
            $table->decimal('paid',25,4)->default(0);
            $table->integer('return_id')->default(null);
            $table->decimal('surcharge')->default(0);
            $table->string('return_sale_ref')->default(null);
            $table->integer('sale_id')->default(null);
            $table->decimal('return_sale_total',25,4)->default(0);
            $table->string('payment_method',255);
            $table->integer('user_id');
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
        Schema::dropIfExists('pos_sales');
    }
}
