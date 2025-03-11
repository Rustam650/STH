<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Проверяем, существует ли таблица перед созданием
        if (!Schema::hasTable('stone_types')) {
            Schema::create('stone_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->text('full_description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stone_types');
    }
}
