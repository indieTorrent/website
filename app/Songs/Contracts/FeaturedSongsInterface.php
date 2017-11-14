<?php

namespace App\Songs\Contracts;

interface FeaturedSongsInterface
{
    public function getSongs();
    public function getSongIds();
    public function getCooldownArtistIds();
    public function isArtistInCooldown($artist_id);
    public function addArtistToCooldown($artist_id);
    public function removeArtistFromCooldown($artist_id);
    public function addRandomSong($rank = 1);
    public function removeSong($song_id);

}