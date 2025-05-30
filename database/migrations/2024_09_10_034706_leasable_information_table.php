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
        Schema::create('leasable_space', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("space_id");
            $table->foreign("space_id")->references("id")->on("space")->cascadeOnDelete();
            $table->unsignedBigInteger("owner_id")->nullable();
            $table->foreign("owner_id")->references("id")->on("owner");
            $table->integer("proposal_id")->nullable();
            $table->smallInteger("status");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leasable_space');
        
    }
};
