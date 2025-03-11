<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stone_types', function (Blueprint $table) {
            // Проверяем, существуют ли столбцы перед их созданием
            if (!Schema::hasColumn('stone_types', 'full_description')) {
                $table->text('full_description')->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('stone_types', 'image')) {
                $table->string('image')->nullable()->after('full_description');
            }
            
            // Добавьте здесь другие новые поля, если необходимо
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stone_types', function (Blueprint $table) {
            if (Schema::hasColumn('stone_types', 'full_description')) {
                $table->dropColumn('full_description');
            }
            
            if (Schema::hasColumn('stone_types', 'image')) {
                $table->dropColumn('image');
            }
            
            // Также удалите здесь другие поля, если они были добавлены
        });
    }
}
