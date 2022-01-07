<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('client_id')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('is_gamma_user')->nullable();
            $table->string('registered_at')->nullable();
            $table->string('is_active')->nullable();
            $table->string('client_image_id')->nullable();
            $table->string('card_image_id')->nullable();
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
        Schema::dropIfExists('client_data');
    }
}
