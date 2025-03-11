<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('background_image');
            $table->integer('position')->default(0); // Для сортировки секций
            $table->boolean('is_hero')->default(false); // Флаг для главной секции с кнопками
            $table->boolean('active')->default(true); // Для включения/отключения секций
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_sections');
    }
}
