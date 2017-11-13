<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

}
