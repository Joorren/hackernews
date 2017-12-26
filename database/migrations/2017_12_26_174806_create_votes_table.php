<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('votes')) {
            Schema::create('votes', function (Blueprint $table) {
                $table->increments('id')->index();
                $table->tinyInteger('vote');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
                $table->integer('post_id')->unsigned();
                $table->foreign('post_id')
                    ->references('id')->on('posts')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
