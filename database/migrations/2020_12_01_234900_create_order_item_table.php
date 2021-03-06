<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('price_total');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('order')
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
        Schema::dropIfExists('order_item');
    }
}
