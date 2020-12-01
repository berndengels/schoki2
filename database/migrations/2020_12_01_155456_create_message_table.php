<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('music_style_id')->nullable();
            $table->foreign('music_style_id')
                ->references('id')
                ->on('music_style')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('email', 100);
            $table->string('name',50);
            $table->longText('message');
            $table->timestamp('created_at');

            $table->index(['email','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
