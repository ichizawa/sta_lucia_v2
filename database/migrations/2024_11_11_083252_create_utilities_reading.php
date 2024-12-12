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
            $table->bigInteger('proposal_id');
            $table->unsignedBigInteger('utility_id')->nullable();
            // $table->foreign('utility_id')->references('id')->on('utilities_selected');
            $table->float('present_reading')->nullable();
            $table->float('previous_reading')->nullable();
            $table->date('present_reading_date')->nullable();
            $table->date('previous_reading_date')->nullable();
            $table->float('consumption')->nullable();
            $table->float('utility_price')->nullable();
            $table->float('total_reading')->nullable();
            $table->string('date_reading')->nullable();
            $table->smallInteger('prepare');
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
