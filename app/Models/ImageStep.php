<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageStep extends Model
{
    //
    protected $guarded = ['id'];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
}
