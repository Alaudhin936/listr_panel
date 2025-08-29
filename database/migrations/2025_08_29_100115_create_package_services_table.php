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
        Schema::create('package_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_catagory');
            $table->text('services');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('agent_id');
            $table->string('booking_date');
            $table->foreign('supplier_id')->on('trade_persons')->references('id')->onDelete('cascade');
            $table->foreign('package_id')->on('package_types')->references('id')->onDelete('cascade');
            $table->foreign('agent_id')->on('agents')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};
