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
        Schema::create('temp_for_conduct', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->string('name');
            $table->enum('type', ['email', 'sms']);
            $table->string('subject')->nullable();
            $table->text('content');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_for_conduct');
    }
};