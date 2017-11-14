<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedSongsCooldownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_songs_cooldown', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('song_id');
            $table->foreign('song_id')->references('id')->on('songs');
            $table->unsignedInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->string('expires')->default(Carbon::now()->addMonth(6));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_songs_cooldown');
    }
}
