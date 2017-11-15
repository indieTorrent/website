<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_artists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->unsignedInteger('label_id');
            $table->foreign('label_id')->references('id')->on('labels');
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
        Schema::dropIfExists('label_artists');
    }
}
