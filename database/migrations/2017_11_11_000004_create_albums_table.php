<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('music_entities');
            $table->string('title');
            $table->string('alt_title')->nullable();
            $table->enum('type', ['f', 't']);
            $table->unsignedSmallInteger('year');
            $table->unsignedSmallInteger('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('description')->nullable();
            $table->boolean('has_explicit_lyrics');
            $table->unsignedDecimal('full_album_price', 8, 2)->nullable();
            $table->unsignedInteger('rank')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedInteger('deleter_id')->nullable();
            $table->foreign('deleter_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
