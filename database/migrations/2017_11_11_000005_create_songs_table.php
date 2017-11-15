<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alt_name')->nullable();
            $table->unsignedInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albums');
            $table->unsignedTinyInteger('song_order');
            $table->unsignedInteger('sku_id')->nullable();
            $table->foreign('sku_id')->references('id')->on('skus');
            // TODO This value should be stored on the audio file table; delete once confirmed. -Ben
            #$table->string('sha256', 64)->nullable();
            $table->unsignedDecimal('preview_start', 7, 3)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_in_back_catalog')->default(false);
            $table->unsignedInteger('catalog_id')->nullable();
            // TODO Re-implement when catalogs table exists. -Ben
            #$table->foreign('catalog_id')->references('id')->on('catalogs');
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
        Schema::dropIfExists('songs');
    }
}
