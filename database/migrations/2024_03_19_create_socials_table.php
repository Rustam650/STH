<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->text('icon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('socials');
    }
};
