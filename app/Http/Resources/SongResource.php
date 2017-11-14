<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SongResource extends Resource
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
            'id' => $this->id,
            'name' => $this->name,
            'alt_name' => $this->alt_name,
            'album' => new AlbumResource($this->album),
            'song_order' => $this->song_order,
            'sku' => $this->sku,
            'preview_start' => $this->preview_start,
            'is_active' => $this->is_active,
            'is_in_back_catalog' => $this->is_in_back_catalog,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
