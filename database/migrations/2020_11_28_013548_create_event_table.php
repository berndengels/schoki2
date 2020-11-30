<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('theme_id')->nullable();
            $table->foreign('theme_id')
                ->references('id')
                ->on('theme')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('admin_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('admin_users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->longText('links')->nullable();
            $table->date('event_date');
            $table->time('event_time');
            $table->decimal('price')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_periodic')->default(false)->nullable();

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
        Schema::dropIfExists('event');
    }
}
