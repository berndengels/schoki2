<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('menu')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('menu_item_type_id')->nullable();
            $table->foreign('menu_item_type_id')
                ->references('id')
                ->on('menu_item_type')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->binary('name', 50);
            $table->string('icon', 50)->nullable();
            $table->string('fa_icon', 50)->nullable();
            $table->string('url')->nullable();
            $table->integer('lft', false);
            $table->integer('rgt', false);
            $table->integer('lvl', false);
            $table->boolean('api_enabled')->default(false);
            $table->boolean('is_published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
