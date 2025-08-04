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
        Schema::create('fruits', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); //The common name of the fruit (e.g., "Apple", "Banana", "Mango").
            $table->string('scientific_name')->nullable(); // The scientific name of the fruit (e.g., "Malus domestica", "Cucumis melo", "Mangifera indica").
            $table->string('color', 50); // The color of the fruit (e.g., "Red", "Green", "Yellow").
            $table->string('taste_profile', 100)->nullable(); // A description of the taste profile of the fruit (e.g., "Sweet", "Sour", "Bitter").
            $table->string('season', 50);  // The season in which the fruit is typically grown (e.g., "Spring", "Summer", "Fall", "Winter").
            $table->boolean('is_seasonal')->default(false); // Whether the fruit is seasonal or available year-round. Good for boolean filtering.
            $table->decimal('price_per_kg', 8, 2); // Example price per kilogram. Good for numeric operations.
            $table->string('origin_country', 100); // The primary country of origin.
            $table->text('description')->nullable(); // A longer description of the fruit.
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fruits');
    }
};
