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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('dti_reg')->nullable();
            $table->string('valid_id1')->nullable();
            $table->string('valid_id2')->nullable();
            $table->string('sec_reg')->nullable();
            $table->string('valid_idSig1')->nullable();
            $table->string('valid_idSig2')->nullable();
            $table->string('bir_cor')->nullable();
            $table->string('comp_prof')->nullable();
            $table->string('menu_list')->nullable();
            $table->string('store_persp')->nullable();
            $table->string('franch_letter')->nullable();
            $table->string('car_letter')->nullable();
            $table->string('service_letter')->nullable();
            $table->string('realty_letter')->nullable();
            $table->string('hlurb')->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
