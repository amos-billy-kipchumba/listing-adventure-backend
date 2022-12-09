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
            $table->comment('');
            $table->bigIncrements('id');
            $table->tinyInteger('status')->default(0);
            $table->string('Amount', 20)->nullable();
            $table->string('CheckoutRequestID', 255);
            $table->string('MerchantRequestID', 255);
            $table->string('MpesaReceiptNumber', 255)->nullable();
            $table->string('TransactionDate', 255)->nullable();
            $table->string('PhoneNumber', 15)->nullable();
            $table->dateTime('updateTime')->useCurrent();

            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('number_of_guests')->nullable();
            $table->string('number_of_days')->nullable();
            $table->string('number_of_hours')->nullable();

            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('house_id');
            $table->foreign('user')->references('id')->on('dineusers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('house_details')->onUpdate('cascade')->onDelete('cascade');
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
