<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicEntity extends Model
{

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

}
