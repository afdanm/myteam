<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_category_id');
            $table->foreignId('user_id');
            $table->string('image_path', 255);
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('excerpt', 255);
            $table->text('content');
            $table->date('published_at');
            $table->boolean('highlite')->default(false);
            $table->text('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
