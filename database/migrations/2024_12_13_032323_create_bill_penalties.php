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
        Schema::create('bill_penalties', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            $table->string('remarks')->nullable();
            $table->float('amount')->nullable();
            $table->float('balance')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->dateTime('date_created')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_penalties');
    }
};
