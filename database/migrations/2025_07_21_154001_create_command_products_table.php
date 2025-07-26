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
        Schema::create('command_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('command_id')->nullable();
            $table->foreign('command_id')->references('id')->on('commandes')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('produits')->onDelete('cascade');

            $table->unsignedBigInteger('magasin_id')->nullable();
            $table->foreign('magasin_id')->references('id')->on('magasins')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->decimal('remise')->nullable();
            $table->string('prix_remise')->nullable(); // prix_remise = unit_price - remise
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable(); // total = quantity * unit_price
            $table->decimal('total_remise', 10, 2)->nullable(); // total_remise = quantity * prix_remise

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('command_products');
    }
};
