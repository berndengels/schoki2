<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedDecimal('price');
            $table->unsignedDouble('price_netto');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_available')->default(false);

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
        Schema::dropIfExists('product');
    }
}
