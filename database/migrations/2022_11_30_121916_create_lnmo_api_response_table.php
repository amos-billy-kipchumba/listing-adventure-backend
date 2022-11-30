<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lnmo_api_response', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('Amount', 20)->nullable();
            $table->string('MpesaReceiptNumber', 255);
            $table->string('CheckoutRequestID', 255);
            $table->string('MerchantRequestID', 255);
            $table->string('TransactionDate', 255)->nullable();
            $table->string('PhoneNumber', 15)->nullable();
            $table->dateTime('updateTime')->useCurrent();
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
        Schema::dropIfExists('lnmo_api_response');
    }
};
