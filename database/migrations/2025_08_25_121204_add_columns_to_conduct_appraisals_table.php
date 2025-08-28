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
            $table->string('main_contact')->nullable();
            $table->string('main_contact_first_name')->nullable();
            $table->string('main_contact_last_name')->nullable();
            $table->string('main_contact_mobile')->nullable();
            $table->string('main_contact_email')->nullable();

            $table->string('study_type')->nullable();
            $table->string('kitchen_condition_quick')->nullable();

            // Smart Send fields
            $table->date('auction_eoi_date')->nullable();
            $table->date('photography_date')->nullable();
            $table->date('internet_launch_date')->nullable();
            $table->date('first_open_inspection_date')->nullable();
            $table->string('marketing_package')->nullable();
            $table->string('commission_proposal')->nullable();
            $table->string('second_agent')->nullable();
            $table->string('contact_who')->nullable();

            // Store marketing discussed as JSON to handle multiple checkboxes
            $table->json('marketing_discussed_checkboxes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conduct_appraisals', function (Blueprint $table) {
            $table->dropColumn([
                'main_contact',
                'main_contact_first_name',
                'main_contact_last_name',
                'main_contact_mobile',
                'main_contact_email',
                'study_type',
                'kitchen_condition_quick',
                'auction_eoi_date',
                'photography_date',
                'internet_launch_date',
                'first_open_inspection_date',
                'marketing_package',
                'commission_proposal',
                'second_agent',
                'contact_who',
                'marketing_discussed_checkboxes',
            ]);
        });
    }
};
