<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('author');
            $table->string('author_key')->nullable();
            $table->string('isbn');
            $table->string('cover_url')->nullable();
            $table->integer('cover_i')->nullable();
            $table->integer('year');
            $table->date('publish_date');
            $table->string('publisher')->nullable();
            $table->string('id_goodreads')->nullable();
            $table->string('id_amazon')->nullable();
            $table->string('id_google')->nullable();
            $table->json('metadata');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');
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
