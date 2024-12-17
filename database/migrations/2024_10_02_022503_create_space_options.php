<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mall_codes', function (Blueprint $table) {
            $table->id();
            $table->string('mallnum');
            $table->string('mallname');
            $table->string('malladdress')->nullable();
            $table->string('mallimage')->nullable();
            $table->string('mallfacility')->nullable();
            $table->string('total_area')->nullable();
            $table->string('total_available')->nullable();
            $table->string('total_leased')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        // Schema::create('mall_facility', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('mallid');
        //     $table->foreign('mallid')->references('id')->on('mall_codes')->cascadeOnDelete();
        //     $table->string('mallfacility');
        //     $table->timestamps();
        // });

        Schema::create('building_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mallid');
            $table->foreign('mallid')->references('id')->on('mall_codes')->cascadeOnDelete();
            $table->string('bldgnum');
            $table->string('bldgimage')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        Schema::create('level_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bldgnumid');
            $table->foreign('bldgnumid')->references('id')->on('building_numbers')->cascadeOnDelete();
            $table->string('lvlnum');
            $table->string('lvlimage')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mall_codes');
        Schema::dropIfExists('building_numbers');
        Schema::dropIfExists('level_numbers');
    }
};
