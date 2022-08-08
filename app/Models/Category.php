<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function advertisements()
    {
        return $this->hasMany('App\Models\Advertisement', 'id', 'category_id');
    }
}
