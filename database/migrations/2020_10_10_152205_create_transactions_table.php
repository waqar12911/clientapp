<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_label')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_amountBTC')->nullable();
            $table->string('transaction_amountUSD')->nullable();
            $table->string('transaction_clientId')->nullable();
            $table->string('transaction_merchantId')->nullable();
            $table->string('transaction_timestamp')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
