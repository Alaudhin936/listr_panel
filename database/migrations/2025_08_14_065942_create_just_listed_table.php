<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('just_listed', function (Blueprint $table) {
            $table->id();
            
            // References
            $table->unsignedBigInteger('hotleads_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            
            // Vendor 1
            $table->string('vendor1_first_name')->nullable();
            $table->string('vendor1_last_name')->nullable();
            $table->string('vendor1_mobile')->nullable();
            $table->string('vendor1_email')->nullable();
            $table->text('vendor1_address')->nullable();
            
            // Vendor 2
            $table->boolean('has_additional_vendor')->default(false);
            $table->string('vendor2_first_name')->nullable();
            $table->string('vendor2_last_name')->nullable();
            $table->string('vendor2_mobile')->nullable();
            $table->string('vendor2_email')->nullable();
            
            // Main point of contact
            $table->string('main_contact')->nullable();
            $table->string('main_contact_first_name')->nullable();
            $table->string('main_contact_last_name')->nullable();
            $table->string('main_contact_mobile')->nullable();
            $table->string('main_contact_email')->nullable();
            
            // Campaign Details
            $table->string('method_of_sale')->nullable();
            $table->date('auction_date')->nullable();
            $table->date('first_open_date')->nullable();
            $table->date('expressions_closing_date')->nullable();
            $table->text('other_method_details')->nullable();
            $table->string('potential_auction_discussed')->nullable();
            
            // Display Order of Agents
            $table->string('first_agent')->nullable();
            $table->string('first_agent_other')->nullable();
            $table->string('second_agent')->nullable();
            $table->string('second_agent_other')->nullable();
            $table->boolean('has_third_agent')->default(false);
            $table->string('third_agent')->nullable();
            $table->string('third_agent_other')->nullable();
            
            // Privacy Consent
            $table->boolean('privacy_consent')->default(false);
            
            // Photography Services
            $table->json('photography_services')->nullable();
            $table->text('other_photography_requirements')->nullable();
            $table->string('photography_supplier')->nullable();
            
            // Copywriting Services
            $table->json('copywriting_services')->nullable();
            $table->string('copywriting_supplier')->nullable();
            
            // Floorplan Services
            $table->json('floorplan_services')->nullable();
            $table->string('floorplan_supplier')->nullable();
            
            // Other Marketing Services
            $table->boolean('other_marketing_required')->default(false);
            $table->text('other_marketing_details')->nullable();
            
            // Other Suppliers
            $table->boolean('other_supplier_needed')->default(false);
            $table->string('supplier_name')->nullable();
            $table->string('supplier_category')->nullable();
            $table->text('supplier_requirements')->nullable();
            $table->string('supplier_mobile')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('supplier_contact_method')->nullable();
            
            // Appointment Dates
            $table->json('appointment_schedule_options')->nullable();
            $table->date('all_appointments_date')->nullable();
            $table->date('photography_date')->nullable();
            $table->date('video_date')->nullable();
            $table->text('custom_booking_instructions')->nullable();
            $table->string('proofs_destination')->nullable();
            
            // Property Access Details
            $table->string('occupancy_status')->nullable();
            $table->string('renters_name')->nullable();
            $table->string('renters_phone')->nullable();
            $table->string('property_access')->nullable();
            $table->text('other_access_arrangements')->nullable();
            $table->string('keysafe_type')->nullable();
            $table->string('keysafe_code')->nullable();
            $table->string('keysafe_location')->nullable();
            $table->text('other_keysafe_location')->nullable();
            $table->string('alarm_system')->nullable();
            $table->text('alarm_instructions')->nullable();
            $table->text('additional_notes')->nullable();
            
            // Trades
            $table->json('trades_no_access')->nullable();
            $table->json('trades_require_access')->nullable();
            $table->text('other_trades_needed')->nullable();
            $table->string('trades_contact_method')->nullable();
            $table->string('vacant_access_instructions')->nullable();
            $table->text('painting_notes')->nullable();
            $table->text('gardening_notes')->nullable();
            
            // Agent Controls
            $table->string('listing_status')->nullable();
            $table->string('open_home_attendance')->nullable();
            $table->boolean('assign_task')->default(false);
            $table->string('task_template')->nullable();
            $table->text('task_message')->nullable();
            $table->string('task_recipient')->nullable();
            $table->string('task_method')->nullable();
            $table->boolean('assign_additional_task')->default(false);
            $table->string('additional_task_template')->nullable();
            $table->text('additional_task_message')->nullable();
            $table->string('additional_task_recipient')->nullable();
            $table->string('additional_task_method')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('hotleads_id')->references('id')->on('hot_leads')->onDelete('set null');
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('just_listed');
    }
};