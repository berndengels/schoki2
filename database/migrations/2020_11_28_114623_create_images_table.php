<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('event_id');
            $table->foreign('event_id')
                ->references('id')
                ->on('event')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('theme_id');
            $table->foreign('theme_id')
                ->references('id')
                ->on('theme')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('event_periodic_id');
            $table->foreign('event_periodic_id')
                ->references('id')
                ->on('event_periodic')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('event_template_id');
            $table->foreign('event_template_id')
                ->references('id')
                ->on('event_template')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('external_filename', 100);
            $table->string('internal_filename', 100);
            $table->string('title', 100);
            $table->string('extension', 4);
            $table->integer('filesize',false,true);
            $table->integer('width',false,true);
            $table->integer('height',false,true);

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('admin_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')
                ->references('id')
                ->on('admin_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('images');
    }
}
