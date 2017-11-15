<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->string('tagline')->nullable();
            $table->text('band_members')->nullable();
            $table->text('influences')->nullable();
            $table->text('self_description')->nullable();
            $table->string('record_label')->nullable();
            $table->string('record_label_type')->nullable();
            $table->text('personal_playlist')->nullable();
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
        Schema::dropIfExists('artist_profile');
    }
}
