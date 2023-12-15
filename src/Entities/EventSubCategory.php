<?php

namespace Creode\LaravelNovaEvents\Entities;

use Illuminate\Database\Eloquent\Model;

class EventSubCategory extends Model
{
    protected $fillable = [];

    public function category()
    {
        return $this->belongsTo(\Creode\LaravelNovaEvents\Entities\EventCategory::class, 'category_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(\Creode\LaravelNovaEvents\Entities\Event::class, 'sub_category_id', 'id');
    }

}
