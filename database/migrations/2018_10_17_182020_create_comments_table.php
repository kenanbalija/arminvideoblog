<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); // FOREIGN KEY KOLONA USER_ID IZ TABELE USeRS
            $table->foreign('user_id')->references('id')->on('users'); // FOREIGN KEY KOLONA USER_ID IZ TABELE USeRS
            $table->integer('post_id')->unsigned(); // FOREIGN KEY KOLONA POST_ID IZ TABELE USeRS
            $table->foreign('post_id')->references('id')->on('posts'); // FOREIGN KEY KOLONA POST_ID IZ TABELE USeRS
            $table->string('value');
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
        Schema::dropIfExists('comments');
    }
}
