<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Http\Resources\Api\Tag as TagResource;

class Advertisement extends Model
{    
    protected $fillable = [
        'advertiser_id',
        'category_id',        
        'title',
        'description',
        'tags',
        'start_date'
    ];

    protected $appends = ['advertise_tags'];

    public function getAdvertiseTagsAttribute($value)
    {
        $advertise_tags = Tag::whereIn('id', json_decode($this->tags, true))->get();
        return TagResource::collection($advertise_tags);
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function advertisers()
    {
        return $this->belongsTo('App\Models\Advertiser', 'advertiser_id', 'id');
    }

    
}
