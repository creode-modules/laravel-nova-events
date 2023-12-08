<?php

namespace Modules\Events\Entities;

use Illuminate\Database\Eloquent\Model;

class EventSubCategory extends Model
{
    protected $fillable = [];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'sub_category_id', 'id');
    }

}
