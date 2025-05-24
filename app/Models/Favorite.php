<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $guarded = ['id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
