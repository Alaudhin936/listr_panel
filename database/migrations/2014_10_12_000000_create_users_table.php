<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');                        // Agency name
        $table->string('email')->unique();             // Login email
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');                    // Login password
        $table->string('phone')->nullable();           // Mobile number
        $table->string('register_number')->nullable(); // Company reg. no
        $table->text('address_line1')->nullable();
        $table->text('address_line2')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
        $table->string('zipcode')->nullable();
        $table->string('contact_person')->nullable();
        $table->string('landline')->nullable();
        $table->string('status')->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('users');
    }
};