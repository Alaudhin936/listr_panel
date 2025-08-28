<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->string('name');
            $table->enum('type', ['email', 'sms']);
            $table->text('content');
            $table->string('subject')->nullable(); // Only for email templates
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->index(['agent_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
};