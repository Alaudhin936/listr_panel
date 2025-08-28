<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('booking_appraisals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');

            // Property Details
            $table->string('address')->nullable();
            $table->string('property_type')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('living_areas')->nullable();
            $table->string('study')->nullable();
            $table->integer('under_cover_parking')->nullable();
            $table->string('condition')->nullable();
            $table->text('what_was_updated')->nullable();
            $table->string('land_size')->nullable();

            // Vendor 1 Details
            $table->string('vendor1_first_name')->nullable();
            $table->string('vendor1_last_name')->nullable();
            $table->string('vendor1_mobile')->nullable();
            $table->string('vendor1_email')->nullable();

            // Vendor 2 Details
            $table->string('vendor2_first_name')->nullable();
            $table->string('vendor2_last_name')->nullable();
            $table->string('vendor2_mobile')->nullable();
            $table->string('vendor2_email')->nullable();

            $table->string('someone_first_name')->nullable();
            $table->string('someone_last_name')->nullable();



            $table->text('comparable_types')->nullable();
            $table->string('comparable_date_range')->nullable();

            $table->string('comparable_notes')->nullable();
            $table->string('who_is_preparing')->nullable();


            $table->string('vendor_moving_to')->nullable();
            $table->string('property_listed_when')->nullable();
            // Appointment Details
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('lead_source')->nullable();
            $table->text('lead_source_notes')->nullable();
            $table->string('category')->nullable();

            // Selling Details
            $table->string('is_vendor_selling')->nullable();
            $table->string('moving_to')->nullable();
            $table->string('when_listing')->nullable();

            // Confirmation Details
            $table->string('send_confirmation_sms')->nullable();
            $table->string('send_confirmation_email')->nullable();
            $table->text('message_preview')->nullable();
            $table->string('save_to_crm')->nullable();
            $table->string('comparable_sales')->nullable();
            $table->string('added_to_calendar')->nullable();
            $table->text('additional_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_appraisals');
    }
};
