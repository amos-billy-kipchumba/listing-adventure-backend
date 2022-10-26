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
        Schema::create('seventy_five', function (Blueprint $table) {
            $table->id();
            $table->string('bathtub')->nullable();
            $table->string('hair_drier')->nullable();
            $table->string('washer')->nullable();
            $table->string('drier')->nullable();
            $table->string('essentials')->nullable();
            $table->string('iron')->nullable();
            $table->string('tv')->nullable();
            $table->string('air_condition')->nullable();
            $table->string('heating')->nullable();
            $table->string('wifi')->nullable();
            $table->string('refrigeration')->nullable();
            $table->string('microwave')->nullable();
            $table->string('dishes_silverware')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('blender')->nullable();
            $table->string('coffee_maker')->nullable();
            $table->string('fire_extinguisher')->nullable();
            $table->string('bread_toaster')->nullable();
            $table->string('patio_balcony')->nullable();
            $table->string('backyard')->nullable();
            $table->string('outdoor_grill')->nullable();
            $table->string('beach_essential')->nullable();
            $table->string('pool')->nullable();
            $table->string('parking')->nullable();
            $table->string('long_term')->nullable();
            $table->string('private_entrance')->nullable();
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
        Schema::dropIfExists('seventy_five');
    }
};
