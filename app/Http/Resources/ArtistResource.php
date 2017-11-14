<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\Resource;

class ArtistResource extends Resource
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
            'moniker' => $this->moniker,
            'alt_moniker' => $this->alt_moniker,
            'city' => $this->city,
            'territory' => $this->territory,
            'country' => $this->country,
            'official_url' => $this->official_url,
            'profile_url' => $this->profile_url,
            'is_active' => $this->is_active,
            'approved_at' => $this->approved_at,
            'approver' => User::find($this->approver_id)->first(),
            'owner' => $this->user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
