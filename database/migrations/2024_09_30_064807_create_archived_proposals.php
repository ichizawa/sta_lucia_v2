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
        Schema::create('archived_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tenant_id");
            $table->foreign("tenant_id")->references("owner_id")->on("company");
            $table->string("proposal_uid");
            $table->string("bussiness_nature");
            $table->integer('discount')->nullable();
            $table->float("brent")->nullable();
            $table->float("total_rent");
            $table->float("min_mgr")->nullable();
            $table->string("lease_term");
            $table->string("commencement");
            $table->string("end_contract");
            $table->string("const_period");
            $table->string("rent_deposit");
            $table->string("sec_dep");
            $table->string("escalation_rate");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archived_proposals');
    }
};
