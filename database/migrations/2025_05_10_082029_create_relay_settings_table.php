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
        Schema::create('relay_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('mode', ['otomatis', 'manual'])->default('otomatis');
            $table->boolean('status_relay')->default(false); // false = mati, true = nyala
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relay_settings');
    }
};
