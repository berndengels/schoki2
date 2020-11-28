<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPeriodicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_periodic', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('theme_id');
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

            $table->string('periodic_position',50);
            $table->string('periodic_weekday', 50);

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

            $table->string('title');
            $table->string('subtitle');
            $table->longText('description');
            $table->longText('links');
            $table->date('event_date');
            $table->time('event_time');
            $table->decimal('price')->nullable();
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('event_periodic');
    }
}
