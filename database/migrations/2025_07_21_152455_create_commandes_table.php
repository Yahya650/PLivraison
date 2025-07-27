<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('quartier')->nullable();
            $table->string('adresse')->nullable();
            $table->string('province')->nullable();

            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('delivery_price', 10, 2)->nullable();

            $table->boolean('is_valid')->default(false)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
