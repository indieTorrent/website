<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AlbumResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'artist' => new ArtistResource($this->artist),
            'title' => $this->title,
            'alt_title' => $this->alt_title,
            'type' => $this->type,
            'year' => $this->year,
            'genre' => $this->genre,
            'description' => $this->description,
            'has_explicit_lyrics' => $this->has_explicit_lyrics,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
