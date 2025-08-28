<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('agents', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('agency_id')->nullable();
        $table->string('name');                   
        $table->string('email')->unique();        
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');               
        $table->string('phone')->nullable();
        $table->text('address_line1')->nullable();
        $table->text('address_line2')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
        $table->string('zipcode')->nullable();
        $table->string('landline')->nullable();
        $table->rememberToken();
        $table->timestamps();

        $table->foreign('agency_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};