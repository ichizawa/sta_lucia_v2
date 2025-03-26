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
        Schema::create('representative', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id");
            $table->foreign('owner_id')->references('id')->on('owner')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("rep_fname");
            $table->string("rep_lname");
            $table->string("rep_position");
            $table->string("rep_address");
            $table->string("rep_email");
            $table->string("rep_telephone");
            $table->time("rep_officehrs");
            $table->time("rep_afterofficehrs");
            $table->string("rep_mobile", 11);
            $table->integer("status");
            $table->string("password");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representative');
    }
};
