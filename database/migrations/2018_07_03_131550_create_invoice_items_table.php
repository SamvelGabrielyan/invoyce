<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id', 255)->nullable(false)->comment('this id is coming from invoice table.');
            $table->string('item', 255)->nullable(false);
            $table->string('rate', 255)->nullable(false);
            $table->string('qty', 255)->nullable(false);
            $table->string('discount', 255)->nullable(false);
            $table->string('discount_type', 255)->nullable(false);
            $table->string('total_amount', 255)->nullable(false);
            $table->text('description')->nullable();
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
        Schema::drop('invoice_items');
    }
}
