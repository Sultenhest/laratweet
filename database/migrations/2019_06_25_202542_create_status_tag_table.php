<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_tag', function (Blueprint $table) {
            $table->primary(['status_id', 'tag_id']);
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_tag');
    }
}
