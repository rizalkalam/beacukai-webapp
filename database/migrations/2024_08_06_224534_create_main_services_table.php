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
            $table->string('title')->nullable();
            $table->text('service_description')->nullable();
            $table->string('title_service_image_1')->nullable();
            $table->string('service_image_1')->nullable();
            $table->string('title_service_image_2')->nullable();
            $table->string('service_image_2')->nullable();
            $table->string('title_service_flow')->nullable();
            $table->text('description_of_service_flow')->nullable();
            $table->string('title_supporting_image_1')->nullable();
            $table->string('supporting_image_1')->nullable();
            $table->text('description_of_supporting_1')->nullable();
            $table->string('title_supporting_image_2')->nullable();
            $table->string('supporting_image_2')->nullable();
            $table->text('description_of_supporting_2')->nullable();
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
