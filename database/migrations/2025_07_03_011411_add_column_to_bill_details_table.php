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
        Schema::table('bill_details', function (Blueprint $table) {
            $table->string('payment_option')->nullable();
            $table->string('reference_num')->nullable();
            $table->string('date_checked')->nullable();
            $table->string('dep_check_num')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_details', function (Blueprint $table) {
            $table->dropColumn('payment_option');
            $table->dropColumn('reference_num');
            $table->dropColumn('date_checked');
            $table->dropColumn('dep_check_num');
        });
    }
};
