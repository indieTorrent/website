<?php

namespace App\Songs\Contracts;

interface FeaturedSongsInterface
{
    public function getSongs();
    public function getSongIds();
    public function getRank($song_id);
    public function getCooldownArtistIds();
    public function hasExpired($expires);
    public function isArtistInCooldown($artist_id);
    public function addArtistToCooldown($artist_id);
    public function removeArtistFromCooldown($artist_id);
    public function addRandomSong($rank);
    public function removeSong($song_id);

}