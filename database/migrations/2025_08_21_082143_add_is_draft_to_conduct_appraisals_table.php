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
        Schema::table('conduct_appraisals', function (Blueprint $table) {
            $table->boolean('is_draft')->default(false);
            $table->dropColumn('hotleads_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conduct_appraisals', function (Blueprint $table) {
                $table->dropColumn(['is_draft']);
                $table->unsignedInteger('hotleads_id');
        });
    }
};
