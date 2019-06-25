<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->primary(['follower_user_id', 'followed_user_id']);
            $table->unsignedBigInteger('follower_user_id');
            $table->unsignedBigInteger('followed_user_id');
            $table->timestamps();

            $table->foreign('follower_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
