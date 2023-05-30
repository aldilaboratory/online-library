<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('isbn', 13)->primary();
            $table->string('title', 250);
            $table->string('author', 150);
            $table->string('image_path', 100);
            $table->string('publisher', 50);
            $table->string('category', 50);
            $table->bigInteger('pages');
            $table->string('language', 20);
            $table->timestamp('publish_date');
            $table->string('subjects', 50);
            $table->text('desc');
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
}
