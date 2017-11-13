<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // TODO: Add necessary pivot table and revisit this relation. -Ben
    /*
    public function genres()
    {

    }
    */

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

}
