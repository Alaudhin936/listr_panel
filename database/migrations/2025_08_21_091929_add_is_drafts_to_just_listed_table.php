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
        Schema::table('just_listed', function (Blueprint $table) {
            $table->unsignedBigInteger('conduct_appraisal_id')->nullable()->after('id');
            $table->boolean('is_draft')->default(false);
            $table->foreign('conduct_appraisal_id')->references('id')->on('conduct_appraisals')->onDelete('set null');
            $table->dropColumn('hotleads_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('just_listed', function (Blueprint $table) {
             $table->dropForeign(['conduct_appraisal_id']);
             $table->dropColumn([
                'is_draft',
                'conduct_appraisal_id',
             ]);
             $table->unsignedInteger('hotleads_id')->nullable();
        });
    }
};
