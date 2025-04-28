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
        Schema::create('extra_charges_selected', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lease_id");
            $table->foreign("lease_id")->references("id")->on("proposal")->cascadeOnDelete();
            $table->unsignedBigInteger("charge_id");
            // $table->foreign("charge_id")->references("id")->on("charges");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_charges_selected');
    }
};
