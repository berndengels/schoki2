<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('address_category_id');
            $table->foreign('address_category_id')
                ->references('id')
                ->on('address_category')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('email', 50);
            $table->string('token', 50);
            $table->boolean('info_on_changes')->default(false);
            $table->timestamps();

            $table->unique(['email','token']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
