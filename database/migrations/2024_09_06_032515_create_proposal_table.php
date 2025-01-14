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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tenant_id");
            $table->foreign("tenant_id")->references("owner_id")->on("company");
            $table->string("proposal_uid");
            $table->string("bussiness_nature");
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
            $table->smallInteger('is_counter')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
        // Schema::dropIfExists('space_payment');
        // Schema::dropIfExists('space_utilities');
    }
};
