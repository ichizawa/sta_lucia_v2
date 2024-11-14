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
        //
        Schema::create('amenity_selected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("amenity_id")->nullable();
            $table->foreign("amenity_id")->references("id")->on("amenities");
            $table->unsignedBigInteger("space_id")->nullable();
            $table->foreign("space_id")->references("id")->on("space")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('amenities');
    }
};
