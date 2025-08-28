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
        Schema::table('hot_leads', function (Blueprint $table) {
                 $table->boolean('is_draft')->default(false);
            $table->boolean('converted_to_booking_appraisal')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hot_leads', function (Blueprint $table) {
                        $table->dropColumn([ 'is_draft','converted_to_booking_appraisal']);

        });
    }
};
