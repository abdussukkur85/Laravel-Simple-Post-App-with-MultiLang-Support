<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->text('title');
            $table->text('description');

            $table->unique(['post_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('post_translations');
    }
}
