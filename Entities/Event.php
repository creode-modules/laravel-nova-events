<?php

namespace Modules\Events\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Event extends Model
{
    protected $fillable = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // public function startDate() : Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::create($value)->ISOformat('dddd Do MMMM G')
    //     );
    // }

    // public function endDate() : Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::create($value)->ISOformat('dddd Do MMMM G')
    //     );
    // }

    public function sub_category()
    {
        return $this->belongsTo(EventSubCategory::class, 'sub_category_id', 'id');
    }

    public function category()
    {
        return $this->hasOneThrough(EventCategory::class, EventSubCategory::class, 'id', 'id', 'sub_category_id', 'category_id');
    }

    public function scopePastEvents(Builder $query): void
    {
        $endDateIsNull = $query->whereNull('end_date');

        $query->when($endDateIsNull, function(Builder $query){
            $query->whereDate('start_date', '<', now()->format('Y-m-d H:i:s'));
        })->when(!$endDateIsNull, function(Builder $query){
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
