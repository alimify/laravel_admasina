<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('image')->default('default.png');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('book_link')->nullable()->default(null);
            $table->text('description');
            $table->integer('language_id');
            $table->integer('rating')->default(0);
            $table->integer('views')->default(0);
            $table->boolean('is_active')->default(false);
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
