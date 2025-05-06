<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    //
    protected $guarded = ['id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function images()
    {
        return $this->hasMany(ImageStep::class);
    }
}
