<?php

namespace Creode\LaravelNovaEvents\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Event extends Model
{
    protected $fillable = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function sub_category()
    {
        return $this->belongsTo(\Creode\LaravelNovaEvents\Entities\EventSubCategory::class, 'sub_category_id', 'id');
    }

    public function category()
    {
        return $this->hasOneThrough(
            \Creode\LaravelNovaEvents\Entities\EventCategory::class,
            \Creode\LaravelNovaEvents\Entities\EventSubCategory::class,
            'id',
            'id',
            'sub_category_id',
            'category_id'
        );
    }

    public function scopePastEvents(Builder $query): void
    {
        $endDateIsNull = $query->whereNull('end_date');

        $query->when($endDateIsNull, function (Builder $query) {
            $query->whereDate('start_date', '<', now()->format('Y-m-d H:i:s'));
        })->when(!$endDateIsNull, function (Builder $query) {
            $query->whereDate('start_date', '<', now()->format('Y-m-d H:i:s'))
                ->orWhereDate('end_date', '<', now()->format('Y-m-d H:i:s'));
        });
    }

    public function scopeUpcomingEvents(Builder $query): void
    {
        $query->whereDate('start_date', '>', now()->format('Y-m-d H:i:s'))
            ->orWhereDate('end_date', '>', now()->format('Y-m-d H:i:s'));
    }
}
