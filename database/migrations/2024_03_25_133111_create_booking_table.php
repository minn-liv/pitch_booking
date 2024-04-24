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
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_created')->references('id')->on('users');
            $table->integer('pitch_information_id')->references('id')->on('pitch_information');
            $table->text('note');
            $table->bigInteger('total');
            $table->integer('payment_status')->default(0);
            $table->integer('booking_status')->default(0);
            $table->date('date');
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
        Schema::dropIfExists('booking');
    }
};
