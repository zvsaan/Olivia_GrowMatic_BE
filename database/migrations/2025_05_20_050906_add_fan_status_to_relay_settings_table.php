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
        Schema::table('relay_settings', function (Blueprint $table) {
            $table->boolean('status_relay_fan')->default(0); // 0 = OFF, 1 = ON
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('relay_settings', function (Blueprint $table) {
            //
        });
    }
};
