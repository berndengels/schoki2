<?php

use App\Libs\MyMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhookPaypalTable extends MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhook_paypal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $this->jsonSupported ? $table->json('payload') : $table->text('payload');
            $this->jsonSupported ? $table->json('exception') : $table->text('exception');
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
        Schema::dropIfExists('webhook_paypal');
    }
}
