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
         Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("acc_id");
            $table->unsignedBigInteger("owner_id");
            $table->foreign('owner_id')->references('id')->on('owner')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("tenant_type");
            $table->string("company_name");
            $table->string("store_name");
            $table->string("company_address");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
