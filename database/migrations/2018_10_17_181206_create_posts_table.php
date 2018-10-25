<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); // FOREIGN KEY KOLONA USER_ID IZ TABELE USeRS
            $table->foreign('user_id')->references('id')->on('users'); // FOREIGN KEY KOLONA USER_ID IZ TABELE USeRS
            $table->string('title'); // Naziv posta
            $table->string('body'); // TExt posta
            $table->string('video'); // Ime vide-a
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
        Schema::dropIfExists('posts');
    }
}
