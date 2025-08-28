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
        Schema::table('booking_appraisals', function (Blueprint $table) {
            $table->unsignedBigInteger('hot_lead_id')->nullable()->after('id');
            $table->boolean('is_draft')->default(false);
            $table->boolean('converted_to_conduct_appraisal')->default(false);
            $table->foreign('hot_lead_id')->references('id')->on('hot_leads')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_appraisals', function (Blueprint $table) {
            $table->dropForeign(['hot_lead_id']);
            $table->dropColumn(['hot_lead_id', 'is_draft','converted_to_conduct_appraisal']);
        });
    }
};
