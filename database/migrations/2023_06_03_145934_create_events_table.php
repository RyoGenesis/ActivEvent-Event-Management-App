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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('community_id')->references('id')
            ->on('communities')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('description');
            $table->dateTime('date');
            $table->dateTime('registration_end');
            $table->string('status');
            $table->foreignId('category_id')->references('id')
            ->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('topic')->nullable();
            $table->boolean('has_certificate')->default(false);
            $table->boolean('has_comserv')->default(false);
            $table->boolean('has_sat')->default(false);
            $table->foreignId('sat_level_id')->nullable()->references('id')
            ->on('sat_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->string('speaker')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('additional_form_link')->nullable();
            $table->boolean('exclusive_major')->default(false);
            $table->boolean('exclusive_member')->default(false);
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('max_slot')->default(0);
            $table->boolean('is_highlighted')->default(false);
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
        Schema::dropIfExists('events');
    }
};
