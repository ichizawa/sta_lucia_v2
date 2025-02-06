<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('space', function (Blueprint $table) {
            $table->id();
            $table->string("space_name");
            $table->float("space_area");
            $table->string("mall_code");
            $table->string("bldg_number");
            $table->string("unit_number");
            $table->string("level_number");
            $table->string("store_type");
            $table->string("property_code");
            // $table->integer("fixed_rental")->nullable();
            // $table->integer("per_sqm")->nullable();
            // $table->integer("space_discount");
            $table->string("space_type");
            $table->string('location')->nullable();
            $table->string('remarks')->nullable();
            $table->string("space_img")->nullable();
            $table->integer("space_tag");
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space');
    }
};
