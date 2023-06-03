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
        Schema::create('user_event', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('event_id')->references('id')
            ->on('events')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status');
            $table->string('reasoning')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_event');
    }
};
