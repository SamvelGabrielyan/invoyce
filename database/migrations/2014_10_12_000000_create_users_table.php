<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable(false);
            $table->string('uuid', 36)->nullable(false);
            $table->string('last_name', 100)->nullable(false);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('tax_id')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(false);
            $table->string('zip_code')->nullable(false);
            $table->string('image', 255)->nullable(false);
            $table->string('company', 255)->nullable(false);
            $table->integer('industry')->unsigned()->nullable(false);
            $table->enum('user_type', ['Client', 'Admin'])->nullable(false);
            $table->enum('status', ['Pending-Payment','In-active','Active','Subscription_cancel'])->nullable(false);
            $table->enum('stripe_connected', ['No', 'Yes'])->nullable();
            $table->string('stripe_access_token', 255)->nullable();
            $table->string('stripe_publishable_key', 255)->nullable();
            $table->string('stripe_user_id', 255)->nullable();
            $table->string('stripe_customer_id', 255)->nullable();
            $table->enum('paypal_connected', ['No', 'Yes'])->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
