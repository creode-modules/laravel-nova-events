<?php

namespace Creode\LaravelNovaEvents\Entities;

use Illuminate\Database\Eloquent\Model;
use PawelMysior\Publishable\Publishable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use Publishable, HasFactory;

    /**
     * Sets table for model extensions.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * Resets fillable attributes
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Casts attributes to correct types
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return \Creode\LaravelNovaEvents\Database\Factories\EventFactory::new();
    }

    /**
     * Query scope for past events.
     *
     * @param Builder $query
     * @return void
     */
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

    /**
     * Query scope for upcoming events.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeUpcomingEvents(Builder $query): void
    {
        $query->whereDate('start_date', '>', now()->format('Y-m-d H:i:s'))
            ->orWhereDate('end_date', '>', now()->format('Y-m-d H:i:s'));
    }
}
