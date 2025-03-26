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
        Schema::create('owner', function (Blueprint $table) {
            $table->id();
            $table->string("owner_fname")->nullable();
            $table->string("owner_lname")->nullable();
            $table->string("owner_position")->nullable();
            $table->string("owner_address")->nullable();
            $table->string("owner_email")->nullable();
            $table->string("owner_telephone")->nullable();
            $table->time("owner_officehrs")->nullable();
            $table->time("owner_afterofficehrs")->nullable();
            $table->string("owner_mobile", 11)->nullable();
            // $table->tinyInteger("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner');
    }
};
