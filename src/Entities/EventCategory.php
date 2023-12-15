<?php

namespace Creode\LaravelNovaEvents\Entities;

use Illuminate\Database\Eloquent\Model;
use Creode\LaravelNovaEvents\Entities\Event;

class EventCategory extends Model
{

    protected $fillable = [];

    public function sub_categories()
    {
        return $this->hasMany(EventSubCategory::class, 'category_id', 'id');
    }

    public function events()
    {
        return $this->hasManyThrough(
            \Creode\LaravelNovaEvents\Entities\Event::class,
            \Creode\LaravelNovaEvents\Entities\EventSubCategory::class,
            'category_id',
            'sub_category_id',
            'id',
            'id'
        );
    }
}
