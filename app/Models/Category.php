<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'parent_id'
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute');
    }
}
