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
        Schema::create('award_notice_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('award_notice_id');
            $table->foreign('award_notice_id')->references('id')->on('award_notice');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('owner_id')->on('company');
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('award_notice_files');
    }
};
