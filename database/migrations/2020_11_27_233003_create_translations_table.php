<?php

use App\Libs\MyMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateTranslationsTable extends MyMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namespace')->default('*');
            $table->index('namespace');
            $table->string('group');
            $table->index('group');
            $table->text('key');
            $this->jsonSupported ? $table->jsonb('text') : $table->text('text');
            $this->jsonSupported ? $table->jsonb('metadata')->nullable() : $table->text('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('translations');
    }
}
