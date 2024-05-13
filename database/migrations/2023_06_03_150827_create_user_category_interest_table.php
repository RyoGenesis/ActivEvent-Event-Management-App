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
        Schema::create('user_category_interest', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')
            ->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('user_category_interest');
    }
};
