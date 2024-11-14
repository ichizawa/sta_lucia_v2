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
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('branch_name', 80);
            $table->dateTime('registration_date', 6);
            $table->string('valid_id');
            $table->string('city', 40);
            $table->string('postal_address', 80);
            $table->string('physical_address', 80);
            $table->string('residential_address', 80);
            // $table->string('password', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};