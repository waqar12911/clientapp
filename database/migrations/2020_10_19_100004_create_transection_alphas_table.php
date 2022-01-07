<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransectionAlphasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transection_alphas', function (Blueprint $table) {
           $table->id();
            $table->string('transaction_label')->nullable();
            $table->string('transaction_amountBTC')->nullable();
            $table->string('transaction_amountUSD')->nullable();
            $table->string('payment_hash')->nullable();
            $table->string('payment_preimage')->nullable();
            $table->string('status')->nullable();
            $table->string('msatoshi')->nullable();
            $table->string('destination')->nullable();
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
        Schema::dropIfExists('transection_alphas');
    }
}
