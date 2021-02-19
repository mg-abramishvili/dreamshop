<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'title'
    ];

    public function values()
    {
        return $this->belongsToMany('App\Models\Value');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('value');
    }
}
