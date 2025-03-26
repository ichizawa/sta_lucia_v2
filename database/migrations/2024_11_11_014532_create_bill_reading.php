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
        Schema::create('bill_reading', function (Blueprint $table) {
            $table->id();
            $table->integer('reading_id');
            $table->bigInteger('bill_id');
            $table->unsignedBigInteger('utility_id')->nullable();
            $table->float('present_reading')->nullable();
            $table->float('previous_reading')->nullable();
            $table->date('present_reading_date')->nullable();
            $table->date('previous_reading_date')->nullable();
            $table->float('consumption')->nullable();
            $table->float('utility_price')->nullable();
            $table->float('total_reading')->nullable();
            $table->string('date_reading')->nullable();
            $table->smallInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_reading');
    }
};
