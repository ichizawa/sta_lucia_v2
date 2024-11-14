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
        Schema::create('utilities_selected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lease_id");
            $table->foreign("lease_id")->references("id")->on("proposal")->cascadeOnDelete();
            $table->unsignedBigInteger("utility_id");
            $table->foreign("utility_id")->references("id")->on("utilities");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities_selected');
    }
};
