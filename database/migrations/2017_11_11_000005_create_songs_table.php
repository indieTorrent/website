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
            // todo: remove nullable() from album_id after relationship is valid -mike 11/12/2017
            $table->unsignedInteger('album_id')->nullable();
            $table->foreign('album_id')->references('id')->on('albums');
            $table->unsignedTinyInteger('song_order');
            $table->unsignedInteger('sku_id')->nullable();
            $table->foreign('sku_id')->references('id')->on('skus');
            #$table->string('sha256', 64)->nullable();
            $table->unsignedDecimal('preview_start', 7, 3)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_in_back_catalog')->default(false);
            $table->unsignedInteger('catalog_id')->nullable();
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
