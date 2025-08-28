<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('booking_appraisals', function (Blueprint $table) {
        $table->string('under_cover_parking_type')->nullable()->after('under_cover_parking');
    });
}

public function down()
{
    Schema::table('booking_appraisals', function (Blueprint $table) {
        $table->dropColumn('under_cover_parking_type');
    });
}

};
