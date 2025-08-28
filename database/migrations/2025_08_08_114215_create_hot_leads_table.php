<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hot_leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();

            // Vendor details
            $table->string('vendor_first_name')->nullable();
            $table->string('vendor_last_name')->nullable();
            $table->string('vendor_mobile')->nullable();
            $table->string('vendor_email')->nullable();
            $table->text('vendor_address')->nullable();

            // Category (hot/warm)
            $table->string('category')->nullable();

            // Notes and source
            $table->text('quick_notes')->nullable();
            $table->string('lead_source')->nullable();

            // Selected tradespeople (JSON to store multiple)
            $table->json('selected_tradespeople')->nullable();

            // Tradesperson contact option
            $table->string('tradesperson_contact_option')->nullable();

            // Privacy consent
            $table->boolean('privacy_consent')->nullable();

            // SMS section
            $table->string('followup_sms_template')->nullable();
            $table->text('sms_preview')->nullable();

            // Email section
            $table->string('followup_email_template')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hot_leads');
    }
};
