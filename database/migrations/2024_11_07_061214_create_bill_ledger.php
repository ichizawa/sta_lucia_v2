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
            $table->string('bill_no');
            $table->string('total_sales');
            $table->string('brent');
            $table->string('total_brent');
            $table->string('mgr');
            $table->string('total_mgr');
            $table->string('amount_payable');
            $table->float('total_amount_payable');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
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
