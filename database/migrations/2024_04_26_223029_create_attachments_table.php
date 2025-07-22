<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_id')->unsigned();
            $table->string('table_name');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('path');
            $table->double('filesize');
            $table->string('field')->default('attachment');
            $table->string('extension');
            $table->boolean('is_personal')->default(0);
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
        Schema::dropIfExists('attachments');
    }
};
