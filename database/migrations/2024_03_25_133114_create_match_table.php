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
        Schema::create('match', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by');
            $table->integer('pitch_id');
            $table->integer('pitch_information_id')->nullable();
            $table->text('note');
            $table->text('rules');
            $table->integer('teams_numbers');
            $table->integer('match_status');
            $table->time('duration');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match');
    }
};