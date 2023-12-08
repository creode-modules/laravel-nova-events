<?php

namespace Modules\Events\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCategory extends Model
{

    protected $fillable = [];

    public function sub_categories()
    {
        return $this->hasMany(EventSubCategory::class, 'category_id', 'id');

    }

    public function events()
    {
        return $this->hasManyThrough(Event::class, EventSubCategory::class, 'category_id', 'sub_category_id', 'id', 'id');
    }

}
