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
        Schema::create('event_major', function (Blueprint $table) {
            $table->foreignId('event_id')->references('id')
            ->on('events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('major_id')->references('id')
            ->on('majors')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('event_major');
    }
};
