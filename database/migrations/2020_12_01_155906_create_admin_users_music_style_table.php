<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersMusicStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users_music_style', function (Blueprint $table) {
            $table->unsignedInteger('admin_user_id')->nullable();
            $table->foreign('admin_user_id')
                ->references('id')
                ->on('admin_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('music_style_id')->nullable();
            $table->foreign('music_style_id')
                ->references('id')
                ->on('music_style')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['admin_user_id','music_style_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users_music_style');
    }
}
