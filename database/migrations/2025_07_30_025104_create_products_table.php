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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name (e.g., "Laptop", "Coffee Mug", "Bluetooth Speaker").
            $table->string('category', 100); // Product category (e.g., "Electronics", "Home Goods", "Apparel").
            $table->text('description')->nullable(); // Detailed product description.
            $table->decimal('price', 10, 2); // Product price.
            $table->integer('stock_quantity')->default(0); // Number of items in stock.
            $table->string('sku', 50)->unique(); // Stock Keeping Unit.
            $table->boolean('is_available')->default(true); // Whether the product is currently available.
            $table->decimal('weight_kg', 8, 2)->nullable(); // Product weight in kilograms.
            $table->string('dimensions_cm', 100)->nullable(); // Product dimensions in centimeters.
            $table->foreignId('manufacturer_id')->constrained('manufacturers')->onDelete('cascade'); // Foreign key to manufacturers
            $table->date('release_date');   // Release date of the product
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
        Schema::dropIfExists('products');
    }
};
