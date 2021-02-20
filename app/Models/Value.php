<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute');
    }
}
