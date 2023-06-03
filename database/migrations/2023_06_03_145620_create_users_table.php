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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone',20);
            $table->char('nim',10)->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('campus_id')->references('id')
            ->on('campuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('faculty_id')->references('id')
            ->on('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('major_id')->references('id')
            ->on('majors')->onUpdate('cascade')->onDelete('cascade');
            $table->text('topics')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
