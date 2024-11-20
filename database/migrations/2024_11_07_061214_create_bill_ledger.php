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
        Schema::create('bill_ledger', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tenant_id');
            $table->unsignedBigInteger('proposal_id');
            $table->foreign('proposal_id')->references('id')->on('proposal');
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('id')->on('billing');
            $table->string('bill_no')->nullable();
            $table->string('total_sales')->nullable();
            $table->string('brent')->nullable();
            $table->string('total_brent')->nullable();
            $table->string('mgr')->nullable();
            $table->string('total_mgr')->nullable();
            $table->string('amount_payable')->nullable();
            $table->float('total_amount_payable')->nullable();
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_ledger');
    }
};
