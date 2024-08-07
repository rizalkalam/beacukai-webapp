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
            $table->string('title');
            $table->string('service_description');
            $table->string('title_service_image_1');
            $table->string('service_image_1');
            $table->string('title_service_image_2');
            $table->string('service_image_2');
            $table->string('title_service_flow');
            $table->string('description_of_service_flow');
            $table->string('title_supporting_image_1');
            $table->string('supporting_image_1');
            $table->string('title_supporting_image_2');
            $table->string('supporting_image_2');
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
