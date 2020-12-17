<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedDecimal('price_total');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
//                ->onDelete('cascade')
            ;

            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
//                ->onDelete('cascade')
            ;

            $table->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('order');
    }
}
