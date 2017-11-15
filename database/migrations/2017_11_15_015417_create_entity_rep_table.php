<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityRepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_rep', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
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
        Schema::dropIfExists('artist_rep');
    }
}
