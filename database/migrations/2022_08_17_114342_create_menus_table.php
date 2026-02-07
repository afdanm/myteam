<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->nullable()->unsigned();
            $table->string('nama_menu', 70);
            $table->string('icon', 30)->nullable();
            $table->foreignId('permission_group_id')->nullable()->unsigned();
            $table->string('href', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->tinyInteger('sort')->default('1');            
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
        Schema::dropIfExists('menus');
    }
}
