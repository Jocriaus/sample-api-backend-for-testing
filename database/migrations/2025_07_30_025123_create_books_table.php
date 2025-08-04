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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Book title
            $table->string('author'); // Book author
            $table->string('isbn', 20)->unique(); // International Standard Book Number
            $table->string('genre', 100); // Book genre
            $table->integer('publication_year'); // Year of publication
            $table->string('publisher'); // Book publisher
            $table->integer('pages'); // Number of pages
            $table->string('language', 50); // Book language
            $table->text('summary')->nullable(); // Book summary
            $table->decimal('rating_avg', 2, 1)->nullable(); // e.g., 4.5
            $table->integer('number_of_reviews')->default(0); // Number of reviews
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
        Schema::dropIfExists('books');
    }
};
