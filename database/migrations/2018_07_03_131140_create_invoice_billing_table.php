<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_billing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id', 255)->nullable(false);
            $table->string('fname', 255)->nullable(false);
            $table->string('lname', 255)->nullable(false);
            $table->string('txt_no', 255)->nullable(false);
            $table->date('pay_date')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_billing');
    }
}
