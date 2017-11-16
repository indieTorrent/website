<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_entities', function (Blueprint $table) {
            $table->increments('id');
            #$table->unsignedInteger('musicable_id');
            #$table->string('musicable_type');
            $table->string('moniker');
            $table->string('alt_moniker')->nullable();
            $table->string('city')->nullable();
            $table->string('territory')->nullable();
            $table->string('country_code', 3)->nullable();
            $table->foreign('country_code')->references('code')->on('countries');
            $table->string('official_url')->nullable();
            $table->string('profile_url');
            $table->unsignedInteger('donation_sku_id')->nullable();
            $table->foreign('donation_sku_id')->references('id')->on('skus');
            $table->unsignedInteger('rank')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('approval_key')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedInteger('approver_id')->nullable();
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
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
        Schema::dropIfExists('music_entities');
    }
}
