<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('account_number');
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('contact_email');

            $table->string('contact_phone', 25)->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('shipping_account_provider')->nullable();
            $table->string('shipping_account_number')->nullable();

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade');

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('customers');
    }
}
