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
        Schema::create('utilities_reading', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bill_id');
            $table->unsignedBigInteger('utility_id');
            $table->foreign('utility_id')->references('id')->on('utilities_selected');
            $table->float('present_reading');
            $table->float('previous_reading');
            $table->dateTime('present_reading_date');
            $table->dateTime('previous_reading_date');
            $table->float('consumption');
            $table->float('total_reading');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities_reading');
    }
};
