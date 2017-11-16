<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicEntityProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_entity_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entity_id');
            $table->foreign('entity_id')->references('id')->on('music_entities');
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
        Schema::dropIfExists('music_entity_profiles');
    }
}
