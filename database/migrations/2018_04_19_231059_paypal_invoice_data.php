<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaypalInvoiceData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('paypal_invoice_data', function (Blueprint $table) {
            $table->increments('id',200); 
            $table->string('paypal_invoice_id')->index();
            $table->string('invoice_id');
            $table->string('paypal_invoice_number')->index(); 
            $table->string('paypal_invoice_status', 20);
            $table->string('paypal_invoice_amount', 100);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('paypal_invoice_data');
    }
}
