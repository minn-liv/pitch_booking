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
        Schema::create('pitch_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pitch_type');
            $table->integer('price');
            $table->integer('pitch_id')->references('id')->on('pitch')->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pitch_information');
    }
};
