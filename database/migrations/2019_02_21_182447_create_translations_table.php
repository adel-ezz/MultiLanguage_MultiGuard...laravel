<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('translatable_id')->index();
            $table->string('col_title');
            $table->string('translatable_type');
            $table->string('language');
            $table->longText('content');
            $table->timestamps();
            $table->unique(['translatable_type', 'translatable_id', 'language','col_title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
