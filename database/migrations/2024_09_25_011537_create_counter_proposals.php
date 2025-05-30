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
        Schema::create('counter_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("proposal_id");
            // $table->foreign("proposal_id")->references("id")->on("proposal");
            $table->string("proposal_uid");
            $table->string("bussiness_nature")->nullable();
            $table->float('discount')->nullable();
            $table->float("brent")->nullable();
            $table->float("min_mgr")->nullable();
            $table->float("total_rent")->nullable();
            $table->float("total_mgr")->nullable();
            $table->string("lease_term")->nullable();
            $table->string("commencement")->nullable();
            $table->string("end_contract")->nullable();
            $table->string("const_period")->nullable();
            $table->float("rent_deposit")->nullable();
            $table->float("sec_dep")->nullable();
            $table->float("escalation_rate")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counter_proposals');
    }
};
