<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];

    public function details()
    {
        return $this->belongsToMany('App\Models\Detail');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
