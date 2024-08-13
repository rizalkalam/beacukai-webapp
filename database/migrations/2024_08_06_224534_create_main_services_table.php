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
        Schema::create('main_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sub_title_1')->nullable();
            $table->string('image_1')->nullable();
            $table->text('information_1')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->string('image_2')->nullable();
            $table->text('information_2')->nullable();
            $table->string('sub_title_3')->nullable();
            $table->string('image_3')->nullable();
            $table->text('information_3')->nullable();
            $table->string('sub_title_4')->nullable();
            $table->string('image_4')->nullable();
            $table->text('information_4')->nullable();
            $table->string('sub_title_5')->nullable();
            $table->string('image_5')->nullable();
            $table->text('information_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_services');
    }
};
