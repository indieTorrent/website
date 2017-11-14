<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_songs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('song_id');
            $table->foreign('song_id')->references('id')->on('songs');
            $table->string('expires')->default(Carbon::now()->addWeek(1));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_songs');
    }
}
