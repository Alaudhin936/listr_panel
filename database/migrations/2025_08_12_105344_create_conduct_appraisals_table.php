<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conduct_appraisals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('hotleads_id')->nullable();
            $table->unsignedBigInteger('booking_appraisal_id')->nullable();
            
            // Foreign key constraints
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('hotleads_id')->references('id')->on('hot_leads')->onDelete('set null');
            $table->foreign('booking_appraisal_id')->references('id')->on('booking_appraisals')->onDelete('set null');
            
            // Vendor Information
            $table->string('vendor1_first_name')->nullable();
            $table->string('vendor1_last_name')->nullable();
            $table->string('vendor1_mobile')->nullable();
            $table->string('vendor1_email')->nullable();
            $table->text('vendor1_address')->nullable();
            $table->boolean('has_additional_vendor')->default(false);
            $table->string('vendor2_first_name')->nullable();
            $table->string('vendor2_last_name')->nullable();
            $table->string('vendor2_mobile')->nullable();
            $table->string('vendor2_email')->nullable();
            
            // Property Details
            $table->string('property_type')->nullable();
            $table->string('property_type_quick')->nullable();
            $table->string('more_property_type')->nullable();
            $table->string('other_property_type')->nullable();
            $table->string('property_type_detailed')->nullable();
            $table->string('property_condition')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('living_areas')->nullable();
            $table->integer('toilets')->nullable();
            $table->integer('car_spaces')->nullable();
            $table->string('kitchen_condition')->nullable();
            
            // Kitchen Details (stored as JSON)
            $table->json('kitchen_details')->nullable();
            
            $table->string('year_built')->nullable();
            $table->string('exterior_material')->nullable();
            $table->string('storeys')->nullable();
            $table->decimal('land_size', 10, 2)->nullable();
            $table->decimal('land_size_quick', 10, 2)->nullable();
            $table->integer('more_bedrooms')->nullable();
            $table->integer('more_bathrooms')->nullable();
            $table->integer('more_living_areas')->nullable();
            
            $table->text('agent_notes')->nullable();
            $table->json('property_photos')->nullable();
            
            $table->json('bedroom_details')->nullable();
            $table->json('bathroom_details')->nullable();
            $table->json('living_area_details')->nullable();
            
            // Heating & Cooling
            $table->json('heating')->nullable();
            $table->json('cooling')->nullable();
            $table->integer('split_systems')->nullable();
            
            // Features
            $table->json('extra_features')->nullable();
            $table->json('outdoor_features')->nullable();
            $table->json('outdoor_features_detailed')->nullable();
            
            // Meeting Summary
            $table->string('sale_method')->nullable();
            $table->boolean('key_dates_discussed')->default(false);
            $table->date('auction_date')->nullable();
            $table->date('preferred_launch')->nullable();
            $table->date('first_open')->nullable();
            $table->boolean('commission_discussed')->default(false);
            $table->string('commission_details')->nullable();
            $table->json('marketing_discussed')->nullable();
            $table->text('other_notes')->nullable();
            
            // Contacts
            $table->json('professional_contacts')->nullable();
            
            // Smart Send
            $table->string('follow_up_sms')->nullable();
            $table->text('sms_message')->nullable();
            $table->string('follow_up_email')->nullable();
            $table->boolean('send_proposal')->default(false);
            $table->boolean('include_price')->default(false);
            $table->string('price_information')->nullable();
            $table->string('proposal_method')->nullable();
            $table->json('comparable_sales')->nullable();
            $table->text('personalized_message')->nullable();
            $table->string('vendor_motivation')->nullable();
            
            // Photos
            $table->json('photos')->nullable();
            $table->json('comparable_photos')->nullable();
            
            // Status
            $table->boolean('converted_to_just_listed')->default(false);
            
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conduct_appraisals');
    }
};