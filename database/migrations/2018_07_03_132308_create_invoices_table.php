<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(false)->comment('this id is coming from users table');
            $table->string('subscription_id')->nullable(false);

            $table->enum('save_status', ['0', '1', '2', '3', '4'])
                ->nullable(false)
                ->comment('0 = Not Save Mode, 1 = Save Mode, 2 = Send Invoice, 3 = Pay Invoice, 4 = Cancel');
            $table->enum('notification_status', ['0', '1'])
                ->nullable(false)
                ->comment('0 = Not Send Notification, 1 = Send Notification');
            $table->enum('view_status', ['0', '1'])
                ->nullable(false)
                ->comment('0 = Not View, 1 = Mail View');
            $table->enum('schedule_type', ['0', '1', '2'])
                ->nullable(false)
                ->comment('0 = None, 1 = Date Type, 2 = Days');
            $table->integer('invoice_type')
                ->unsigned()
                ->nullable(false)
                ->comment('1 = STANDARD INVOICE, 2 = SCHEDULED INVOICE, 3 = SUBSCRIPTION INVOICE');
            $table->string('invoice_type_code')
                ->comment('std = STANDARD INVOICE, sch = SCHEDULED INVOICE, rec = RECURRING INVOICE, sub = SUBSCRIPTION INVOICE');

            $table->string('paid_note')->nullable();
            $table->date('send_invoice_date')->nullable(false);
            $table->bigInteger('send_invoice_days')->nullable(false);
            $table->string('invoice_url', 255)->nullable(false);
            $table->string('company_name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('additional_email', 255)->nullable(false);
            $table->string('address', 255)->nullable(false);
            $table->string('city', 255)->nullable(false);
            $table->string('state', 255)->nullable(false);
            $table->string('zip_code', 255)->nullable(false);
            $table->string('phone', 255)->nullable(false);
            $table->string('invoice_title', 255)->nullable(false);
            $table->string('invoice_number', 255)->nullable(false);
            $table->text('invoice_message')->nullable(false);
            $table->text('terms_conditions')->nullable(false);
            $table->float('total_amount')->nullable(false);
            $table->string('invoice_name')->nullable(false);
            $table->string('invoice_customer')->nullable(false);
            $table->bigInteger('pay_count')->nullable(false);
            $table->string('send_paid_email', 1)->nullable(false);
            $table->date('add_date')->nullable(false);
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
        Schema::drop('invoices');
    }
}
