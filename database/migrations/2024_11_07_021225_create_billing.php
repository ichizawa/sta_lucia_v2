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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');
            $table->foreign('proposal_id')->references('id')->on('proposal')->cascadeOnDelete();
            $table->string('billing_uid')->nullable();
            $table->string('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('remarks')->nullable();
            $table->smallInteger('is_prepared')->nullable()->default(0);
            $table->smallInteger('is_paid')->nullable()->default(0);
            $table->smallInteger('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
