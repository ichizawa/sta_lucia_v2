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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('id')->on('billing')->cascadeOnDelete();
            // $table->string('contract_id')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->float('debit')->nullable();
            $table->float('credit')->nullable();
            // $table->float('total_sales')->nullable();
            $table->float('change')->nullable();
            // $table->string('reference_num')->nullable();
            // $table->string('payment_option')->nullable();
            // $table->string('date_from')->nullable();
            $table->string('date_to')->nullable();
            $table->string('remarks')->nullable();
            $table->smallInteger('status')->nullable()->default(0);
            $table->smallInteger('is_paid')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
